<footer>
    <div class="container">
        <div class="row footer-inner">
            <div class="col-md-4 col-12">
                <a href="index.html" class="logo">
                <img src="/fronts/img/icons/logo-white-svg.svg" alt="" />
                </a>
                <p>
                    {{ trans('vars.HeaderFooter.footerText') }}
                </p>
                <div class="networksFooter">
                    <a href="{{ trans('vars.Contacts.linkFB') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/facebook-f-brands.svg" alt="">
                    </a>
                    {{-- <a href="{{ trans('vars.Contacts.linkFB') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/instagram-brands.svg" alt="">
                    </a> --}}
                    <a href="{{ trans('vars.Contacts.linkLinkedIn') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/linkedin-in-brands.svg" alt="">
                    </a>
                    <a href="{{ trans('vars.Contacts.linkYoutube') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/youtube-brands.svg" alt="">
                    </a>
                    <a href="{{ trans('vars.Contacts.linkPinterest') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/pinterest-p-brands.svg" alt="">
                    </a>
                    <a href="{{ trans('vars.Contacts.linkFlickr') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/flickr-brands.svg" alt="">
                    </a>
                    <a href="{{ trans('vars.Contacts.linkTwitter') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/twitter-brands.svg" alt="">
                    </a>
                    <a href="{{ trans('vars.Contacts.linkSlideShare') }}" class="networksFooter-container">
                    <img src="/fronts/img/svg/slideshare-brands.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md col-12">
                <ul>
                    <li class="title">{{ trans('vars.PagesNames.pageNameDespre') }}</li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/prezentare') }}">{{ trans('vars.PagesNames.pageNamePrezentare') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/istoric') }}">{{ trans('vars.PagesNames.pageNameIstoric') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/list/politici') }}">{{ trans('vars.PagesNames.pageNamePolitici') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/list/proiecte') }}">{{ trans('vars.PagesNames.pageNameProiecte') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/strangere-de-fonduri') }}">{{ trans('vars.PagesNames.pageNameFundrasing') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/advocacy') }}">{{ trans('vars.PagesNames.pageNameAdvocacy') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/list/comunicate-de-presa') }}">{{ trans('vars.PagesNames.pageNameComunicate') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/transparenta-financiara') }}">{{ trans('vars.PagesNames.pageNameTransparenta') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/resources/list/posturi-vacante') }}">{{ trans('vars.PagesNames.pageNamePosturi') }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.$lang->lang.'/contacts') }}">{{ trans('vars.PagesNames.pageNameContacts') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md col-12">
                <ul>
                    <li class="title">{{ trans('vars.PagesNames.pageNameServicii') }}</li>
                    <li><a href="{{ url('/'.$lang->lang.'/inregistrare-la-biblioteca') }}">{{ trans('vars.PagesNames.pageNameInregistrareBibl') }}</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/proposes-book') }}">{{ trans('vars.PagesNames.pageNamePropuneAchizitii') }}</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/reguli-de-imprumut') }}">{{ trans('vars.PagesNames.pageNameRegImprumut') }}</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/reguli-de-utilizare-a-calculatoarelor') }}">{{ trans('vars.PagesNames.pageNameReguliUtilizare') }}</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/faq') }}">{{ trans('vars.PagesNames.pageNameIntreaba') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="prefooter">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <p>
                        {{ trans('vars.HeaderFooter.footerCopyright') }} {{ date('Y') }}
                        {{-- Copyright {{ date('Y') }} by Likemedia. All rights reserved. --}}
                    </p>
                </div>
                <div class="col-auto">
                    <p>Created by Likemedia.</p>
                </div>
            </div>
        </div>
    </div>


    <div id="search-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close" data-dismiss="modal"></div>
                <div class="title-modal">{{ trans('vars.PagesNames.pageNameSearch') }}</div>
                <search></search>
            </div>
        </div>
    </div>

</footer>

<div class="modal fade" id="settings-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close" data-dismiss="modal"></div>
      <div class="title-modal">settings</div>
      <form action="">
        <div class="select-container">
          <span>Language</span>
          @php
              $url = '';
              if (request()->path()) {
                  $url = substr(request()->path(), 2);
              }
          @endphp
          <select name="" id="" onchange="if (this.value) window.location.href=this.value">
            <option {{ $lang->lang == 'ro' ? 'selected' : '' }}  value="{{ url('/ro'.$url) }}">RO</option>
            <option {{ $lang->lang == 'ru' ? 'selected' : '' }} value="{{ url('/ru'.$url) }}">RU</option>
            <option {{ $lang->lang == 'en' ? 'selected' : '' }} value="{{ url('/en'.$url) }}">EN</option>
          </select>
        </div>
        {{-- <input type="submit" value="Save" data-dismiss="modal" /> --}}
      </form>
    </div>
  </div>
</div>
