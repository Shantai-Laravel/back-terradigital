<?php

namespace Admin\Http\Controllers;

use App\Base as Model;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Product;

class KohaController extends Controller
{
    public function index()
    {
        return view('admin::admin.opac.index');
    }

    public function synchOpac($opac)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        // $biblionumber = 305754;
        $biblionumber = $opac->opac_id;
        $category_id = $opac->category_id;

        $apiUrl = "https://opac.hasdeu.md/cgi-bin/koha/ilsdi.pl?service=GetRecords&id=".$biblionumber;
        $filename = public_path("/bok.xml");
        $xmlfile = file_get_contents($apiUrl, false, stream_context_create($arrContextOptions));

        $ret = $this->namespacedXMLToArray($xmlfile);
        // dd($xmlfile);

        $data = new \SimpleXMLElement ($ret['record']['marcxml']);
        // $genData = new \SimpleXMLElement ($ret);

        $fields['author'] = "";
        $fields['title'] = "";
        if (array_key_exists('issues', $ret['record'])) {
            if (array_key_exists('issue', $ret['record']['issues'])) {
                if (array_key_exists(0, $ret['record']['issues']['issue'])) {
                    $fields['title'] = $ret['record']['issues']['issue'][0]['title'];
                    if (array_key_exists('author', $ret['record']['issues']['issue'][0])) {
                        $fields['author'] = $ret['record']['issues']['issue'][0]['author'];
                    }
                }else{
                    $fields['title'] = $ret['record']['issues']['issue']['title'];
                    if (array_key_exists('author', $ret['record']['issues']['issue'])) {
                        $fields['author'] = $ret['record']['issues']['issue']['author'];
                    }
                }
            }
        }

        $fields['issn'] = "";
        $fields['co_author'] = "";
        $fields['language'] = "";
        $fields['subject'] = "";
        $fields['publication'] = "";
        $fields['image'] = "https://opac.hasdeu.md//cgi-bin/koha/opac-image.pl?thumbnail=1&biblionumber=".$biblionumber;

        $i = 0;

        foreach ($data as $key => $item) {
            // print_r($item);
            // echo $i."<br>";
            if ($i == 2) { //get issn
                $count = 0;
                foreach ($item->subfield as $key => $value) {
                    $fields['issn'] .= (string)$value.' ';
                    $count++;
                }
                // dd($fields['issn']);
            }

            if ($i == 6) { //get language
                $count = 0;
                foreach ($item->subfield as $key => $value) {
                    $fields['language'] .= (string)$value.' ';
                    $count++;
                }
                // dd($fields['language']);
            }

            if ($i == 8) { //get co_author
                $count = 0;
                foreach ($item->subfield as $key => $value) {
                    $fields['co_author'] .= (string)$value.' ';
                    $count++;
                }
                // dd($fields['co_author']);
            }

            if ($i == 9) { //get publication
                $count = 0;
                foreach ($item->subfield as $key => $value) {
                    $fields['publication'] .= (string)$value.' ';
                    $count++;
                }
                // dd($fields['publication']);
            }

            if ($i == 13) { //get subject
                $count = 0;
                foreach ($item->subfield as $key => $value) {
                    $fields['subject'] .= (string)$value.' ';
                    $count++;
                }
                $fields['subject'] = preg_replace('/[0-9]+/', '', $fields['subject']);
                // dd($fields['subject']);
            }

            if ($fields['author'] == '') {
                if ($i == 14) { //get author
                    $count = 0;
                    foreach ($item->subfield as $key => $value) {
                        $fields['author'] .= (string)$value.' ';
                        $count++;
                    }
                    $fields['author'] = preg_replace('/[0-9]+/', '', $fields['author']);
                    // dd($fields['author']);
                }
            }
            $i++;
        }


        if ($fields['title']) {
            $alias = str_slug($fields['title']);
        }else{
            $alias = uniqid(10);
        }

        $product = Product::create([
            'alias' => $alias,
            'issn' => $fields['issn'],
            'image' => $fields['image'],
            'category_id' => $category_id,
        ]);

        foreach ($this->langs as $key => $langItem) {
            $product->translations()->create([
                'lang_id' => $langItem->id,
                'name' => $fields['title'],
                'author' => $fields['author'],
                'issn' => $fields['issn'],
                'co_author' => $fields['co_author'],
                'language' => $fields['language'],
                'subject' => $fields['subject'],
                'publication' => $fields['publication'],
            ]);
        }

        $opac->update([
            'product_id' => $product->id,
        ]);

        $fields['product_id'] = $product->id;

        return $fields;
    }

    private function removeNamespaceFromXML($xml)
    {
        $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
        // This is part of a regex I will use to remove the namespace declaration from string
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        // Cycle through each namespace and remove it from the XML string
        foreach( $toRemove as $remove ) {
        // First remove the namespace from the opening of the tag
        $xml = str_replace('<' . $remove . ':', '<', $xml);
        // Now remove the namespace from the closing of the tag
        $xml = str_replace('</' . $remove . ':', '</', $xml);
        // This XML uses the name space with CommentText, so remove that too
        $xml = str_replace($remove . ':commentText', 'commentText', $xml);
        // Complete the pattern for RegEx to remove this namespace declaration
        $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
        // Remove the actual namespace declaration using the Pattern
        $xml = preg_replace($pattern, '', $xml, 1);
    }

        // Return sanitized and cleaned up XML with no namespaces
        return $xml;
    }

    private function namespacedXMLToArray($xml)
    {
        // One function to both clean the XML string and return an array
        return json_decode(json_encode(simplexml_load_string($this->removeNamespaceFromXML($xml))), true);
    }
}
