<template>

    <tr class="row100" v-if="ready">
        <td class="column-id">new</td>
    	<td class="column-id">
            <input type="text" :value="lang.lang.toUpperCase()" disabled v-for="lang in langs">
        </td>
       <td class="column-text">
            <input type="text" v-model="product.name[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="biblionumber" placeholder="---">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.issn" placeholder="---">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.author[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.co_author[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.language[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.country[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.publication[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.subject[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.description[lang.id]" placeholder="---" v-for="(lang, index) in langs" @keyup="setChange">
        </td>
        <td class="column-button">
            <p class="text-warning"><small>images can be added only after saving!</small></p>
        </td>
        <td class="column-button">
            <p class="text-warning"><small>similar products can be added only after saving!</small></p>
        </td>
    	<!-- <td class="column-text">
            <input type="text" v-model="product.body[lang.id]" placeholder="-" v-for="(lang, index) in langs">
        </td>
        <td class="column-text">
            <input type="text" v-model="product.atributes[lang.id]" placeholder="-" v-for="(lang, index) in langs">
        </td> -->
    </tr>

</template>

<script>
    import { bus } from '../../app_admin';

    export default {
        props: ['category', 'langs', 'promotions'],
        data(){
            return {
                product : {
                    name : [],
                    description : [],
                    body : [],
                    atributes: [],
                    author: [],
                    co_author: [],
                    language: [],
                    country: [],
                    publication: [],
                    subject: [],
                    code : '',
                    issn: '',
                    price : 0,
                    stoc : 0,
                    discount : 0,
                    promotion : 0,
                },
                biblionumber: '',
                properties : [],
                propertiesCheckbox: [],
                propertiesText : [],
                dependeble: this.category.property ? this.category.property.parameter_id : 0,
                ready: true,
            }
        },
        mounted(){
            // this.getPropValue();
            // this.getPropValueText();
            this.setDefaultValues();
            bus.$on('create', data => {
                this.save();
            })
        },
        methods: {
            setChange(e){
                if (e.target.value) {
                    bus.$emit('documentChange', 'new');
                }
            },
            save(){
                bus.$emit('startLoading');
                axios.post('/back/auto-upload-create', {product: this.product, properties: this.properties, propertiesText: this.propertiesText, propertiesCheckbox: this.propertiesCheckbox, category_id: this.category.id})
                    .then(response => {
                        bus.$emit('updatePage');
                        this.setDefaultValues();
                        // this.getPropValueText();
                        // this.getPropValue();
                        this.product.code = '';
                        this.product.issn = '';
                        this.product.stoc = 0;
                        this.product.price = 0;
                        this.product.discount = 0;
                        this.product.promotion = 0;
                        bus.$emit('clearSearch');
                        bus.$emit('endLoading');
                    })
                    .catch(e => {
                        console.log('error load products');
                    })
            },
            setDefaultValues(){
                let defaultValsName = [];
                let defaultValsDesc = [];
                let defaultValsBody = [];
                let defaultValsAuthor = [];
                let defaultValsCoAuthor = [];
                let defaultValsLanguage = [];
                let defaultValsCountry = [];
                let defaultValsPublication = [];
                let defaultValsSubject = [];

                this.langs.forEach(function(entry){
                    defaultValsName[entry.id] = '';
                    defaultValsDesc[entry.id] = '';
                    defaultValsBody[entry.id] = '';
                    defaultValsAuthor[entry.id] = '';
                    defaultValsCoAuthor[entry.id] = '';
                    defaultValsLanguage[entry.id] = '';
                    defaultValsCountry[entry.id] = '';
                    defaultValsPublication[entry.id] = '';
                    defaultValsSubject[entry.id] = '';
                });


                this.product.name = defaultValsName;
                this.product.description = defaultValsDesc;
                this.product.body = defaultValsBody;

                this.product.author = defaultValsAuthor
                this.product.co_author = defaultValsCoAuthor
                this.product.language = defaultValsLanguage
                this.product.country = defaultValsCountry
                this.product.publication = defaultValsPublication
                this.product.subject = defaultValsSubject
            },
            getPropValue(){
                let vm = this;
                let defaultVal = [];
                let defaultValCheckbox = [];

                 this.category.params.forEach(function (entry) {
                     if (vm.dependeble !== entry.property.id) {
                         if (entry.property.type == 'select') {
                             defaultVal[entry.parameter_id] = 0;
                        }else if(entry.property.type == 'select'){
                            defaultValCheckbox[entry.parameter_id] = [];
                        }
                     }
                 })

                 this.propertiesCheckbox = defaultValCheckbox;
                 this.properties = defaultVal;
            },
            getPropValueText(){
                let vm = this;
                let ret = [];
                let defaultVal = [];

                 this.category.params.forEach(function (entry) {
                     if (entry.property.type == 'textarea' ||  entry.property.type == 'text') {
                        if (entry.property.multilingual == 1) {
                            vm.langs.forEach(function(item, key){
                                ret[key] = '';
                                return ret;
                            })
                        }else{
                            ret[0] = '';
                        }
                        defaultVal[entry.parameter_id] = ret;
                        ret = [];
                     }
                 })
                 this.propertiesText = defaultVal;
            },
        },
    }
</script>
