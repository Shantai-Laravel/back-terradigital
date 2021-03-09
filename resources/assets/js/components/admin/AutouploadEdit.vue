<template>

    <tr class="row100">
        <td class="column-id">{{ index + 1 }}</td>
    	<td class="column-id">
            <input type="text" :value="lang.lang.toUpperCase()" disabled v-for="lang in langs">
        </td>
        <td class="column-text">
            <input type="text" v-model="name[translation.lang_id]=translation.name" placeholder="---" v-for="(translation, index) in product.translations" @keyup="setChange">
        </td>

        <td class="column-number">
            <span><i>{{ strCut(product.translations[0].name) }}</i></span>
            <input type="text" v-model="biblionumber" placeholder="---" @keyup="setChange" disabled>
        </td>

        <td class="column-number">
            <span><i>{{ strCut(product.translations[0].name) }}</i></span>
            <input type="text" v-model="issn=product.issn" placeholder="---" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="author[translation.lang_id]=translation.author" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="co_author[translation.lang_id]=translation.co_author" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="language[translation.lang_id]=translation.language" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="country[translation.lang_id]=translation.country" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="publication[translation.lang_id]=translation.publication" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="subject[translation.lang_id]=translation.subject" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-text">
            <input type="text" v-model="description[translation.lang_id]=translation.description" placeholder="---" v-for="translation in product.translations" @keyup="setChange">
        </td>

        <td class="column-button">
            <span><i>{{ strCut(product.translations[0].name) }}</i></span>
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" :data-target="'#images-modal' + product.id"><i class="fa fa-image"></i> <small>Images</small></button>
        </td>

        <td class="column-button">
            <span><i>{{ strCut(product.translations[0].name) }}</i></span>
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" :data-target="'#categories-modal' + product.id"><i class="fa fa-point"></i> <small>Similar Products</small> </button>
        </td>
    	<!-- <td class="column-text">
            <input type="text" v-model="body[translation.lang_id]=translation.body" placeholder="-" v-for="translation in product.translations" @keyup="setChange">
        </td>
        <td class="column-text">
            <input type="text" v-model="atributes[translation.lang_id]=translation.atributes" placeholder="-" v-for="translation in product.translations" @keyup="setChange">
        </td> -->
        <!-- Images modal -->
        <div class="modal fade bd-example-modal-lg settings-modal" :id="'images-modal' + product.id" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="loading" v-if="loading"><div class="lds-ripple"><div></div><div></div></div></div>
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center"><b>Images : </b> {{ product.translations[0].name }}</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" @click="submit">Upload</button><hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 image-wrapp" v-if="biblionumber">
                                    <img :src="'https://opac.hasdeu.md/cgi-bin/koha/opac-image.pl?thumbnail=1&biblionumber=' + biblionumber">
                                </div>
                                <!-- <div class="col-md-4 image-wrapp" v-for="image in images">
                                    <div class="image-btns text-center">
                                        <span :class="[image.main == 1 ? 'active-btn' : '']"><i class="fa fa-edit" @click="mainImage(image.id)"></i></span>
                                        <span :class="[image.first == 1 ? 'active-btn' : '']" @click="firstImage(image.id, 1)">1</span>
                                        <span :class="[image.first == 2 ? 'active-btn' : '']" @click="firstImage(image.id, 2)">2</span>
                                        <span :class="[image.first == 3 ? 'active-btn' : '']" @click="firstImage(image.id, 3)">3</span>
                                        <span :class="[image.first == 4 ? 'active-btn' : '']" @click="firstImage(image.id, 4)">4</span>
                                        <span :class="[image.first == 5 ? 'active-btn' : '']" @click="firstImage(image.id, 5)">5</span>
                                        <span class="remove-btn"><i class="fa fa-remove" @click="removeImage(image.id)"></i></span>
                                    </div>
                                    <img :src="'/images/products/og/' + image.src" alt="" style="width: 100%;"> <hr>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Products Modal-->
        <div class="modal fade bd-example-modal-lg settings-modal" :id="'categories-modal' + product.id" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="loading" v-if="loading"><div class="lds-ripple"><div></div><div></div></div></div>
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center">Similar Products : {{ product.translations[0].name }}</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="button" @click="setSimilarAll" class="btn btn-primary" name="button">check all</button>
                                                <button type="button" @click="unsetSimilarAll" class="btn btn-primary" name="button">uncheck all</button>
                                            </div>
                                        </div> <hr>
                                    </div>
                                    <div class="row" v-for="category in categories">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="checkbox" v-model="similarProducts[category.id]" :id="'category' + category.id + product.id" @change="setSimilarProducts(category.id)" class="similar-categories">
                                                <label :for="'category' + category.id + product.id"><span>{{ category.translation.name }}</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="checkbox" v-model="hit" id="hit" @change="setHit">
                                            <label for="hit"><span>Lichidare de stoc</span></label>
                                        </div><hr><br>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="checkbox" v-model="recomended" id="recomended" @change="setRecomended">
                                            <label for="recomended"><span>Recomended</span></label>
                                        </div><hr> <br>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </tr>

</template>

<script>
    import { bus } from '../../app_admin';

    export default {
        props: ['category', 'index', 'prod', 'langs', 'promotions', 'sets', 'collections', 'brands', 'categories', 'dillergroups'],
        data(){
            return {
                product: this.prod,
                name : [],
                description : [],
                body : [],
                atributes : [],
                author: [],
                co_author: [],
                language: [],
                country: [],
                publication: [],
                subject: [],
                biblionumber: this.prod.opac ? this.prod.opac.opac_id : 0,
                code : '',
                issn : '',
                price : 0,
                stoc : 0,
                stocks : [],
                discount : 0,
                promotion : 0,
                currencyPrices: [],
                b2bPrices: [],
                video: this.prod.video ? this.prod.video : false,
                hit: this.prod.hit,
                recomended: this.prod.recomended,
                properties : [],
                propertiesCheckbox : [],
                propertiesText : [],
                attachments : [],
                images : this.prod.images,
                imagesFB : this.prod.images_f_b,
                prices: this.prod.prices,
                subproducts : this.prod.subproducts,
                setsAll: this.sets,
                data : new FormData(),
                percentCompleted: 0,
                loading : false,
                setsProduct: [],
                categsProduct: [],
                previewImage: [],
                similarProducts: [],
                collectionsProducts: [],
                brandsProducts: [],
                subproductFields : {
                    'id' : [],
                    'active' : [],
                    'price' : [],
                    'discount' : [],
                    'stoc' : [],
                    'ean_code' : [],
                },
                dillerPrices :[],
                subproductPrices: [],
                subproductDepndablePrice: [],
                dependeble: this.category.property ? this.category.property.parameter_id : 0,
                materials: [],
                checkedMaterials: [],
                materialsModel: [],
                categId: this.category.id,
                warehouses: [],
                warehousesStocks: [],
                warehousesProductStocks: [],
            }
        },
        mounted(){
            bus.$on('save' + this.index, data => {
                this.save();
            })
            bus.$on('refresh', data => {
                this.properties = [];
                // this.getPropValue();
                // this.getPropValueText();
            })
            // this.getPropValue();
            // this.getPropValueCheckbox();
            // this.getPropValueText();
            // this.getProductSets();
            // this.getProductCategs();
            this.getSimilarProduct();
            // this.getCollectionProduct();
            // this.getBrandsProduct();
            // this.getDillersPrices();
        },
        methods: {
            getDillersPrices(){
                bus.$emit('startLoading');
                axios.post('/back/auto-upload-get-diller-prices', {productId: this.product.id})
                    .then(response => {
                        this.dillerPrices = response.data;
                        bus.$emit('endLoading');
                    })
                    .catch(e => {
                        console.log('error load diller prices');
                    })
            },
            parseDillerPrices(prices){
                let ret = [];
                this.dillergroups.forEach(function(entry){
                    prices.forEach(function(price){
                        if (entry.id == price.diller_group_id) {
                            ret.push({eur: price.price});
                        }
                    })
                });
            },
            setChange(){
                bus.$emit('documentChange', this.index);
            },
            save(){
                bus.$emit('startLoading');
                axios.post('/back/auto-upload-edit', {product: this.product, properties: this.properties, propertiesText: this.propertiesText, propertiesCheckbox: this.propertiesCheckbox})
                    .then(response => {
                        bus.$emit('endLoading');
                    })
                    .catch(e => {
                        console.log('error load products');
                    })
            },
            remove(){
                if(confirm("Do you really want to delete?")){
                    axios.post('/back/auto-upload-remove', {product: this.product})
                        .then(response => {
                            bus.$emit('removeProduct', this.index);
                        })
                        .catch(e => {
                            console.log('error load products');
                        })
                }
            },
            getProductSets(){
                let defaultVal = [];
                let defaultModel = [];

                this.product.sets.forEach(function(entry) {
                    defaultVal[ entry.id] = entry.id;
                });

                this.sets.forEach(function(entry){
                    defaultModel[entry.id] = defaultVal.includes(entry.id);
                });

                this.setsProduct = defaultModel;
            },
            getProductCategs(){
                let defaultVal = [];
                let defaultModel = [];

                this.product.product_categories.forEach(function(entry) {
                    defaultVal[entry.category_id] = entry.category_id;
                });

                this.categories.forEach(function(entry){
                    defaultModel[entry.id] = defaultVal.includes(entry.id);
                });

                this.categsProduct = defaultModel;
            },
            getSimilarProduct(){
                let defaultVal = [];
                this.product.similar.forEach(function(entry){
                    defaultVal[entry.category_id] = true;
                });

                this.similarProducts = defaultVal;
            },
            getCollectionProduct(){
                let defaultVal = [];
                this.product.collections.forEach(function(entry){
                    defaultVal[entry.collection_id] = true;
                });

                this.collectionsProducts = defaultVal;
            },
            getBrandsProduct(){
                let defaultVal = [];
                this.product.brands.forEach(function(entry){
                    defaultVal[entry.brand_id] = true;
                });

                this.brandsProducts = defaultVal;
            },
            getPropValue(){
                let vm = this;
                let defaultVal = [];
                let defaultValCheckbox= [];

                 this.category.params.forEach(function (entry) {
                     if (vm.dependeble !== entry.property.id) {
                         if (entry.property.type == 'select') {
                             defaultVal[entry.parameter_id] = vm.getProductValueSelect(entry.parameter_id);
                         }else if(entry.property.type == 'checkbox'){
                             defaultValCheckbox[entry.parameter_id] = vm.getProductValueCheckbox(entry.parameter_id);
                         }
                     }
                 })
                 // console.log(defaultValCheckbox);
                 this.propertiesCheckbox = defaultValCheckbox;
                 this.properties = defaultVal;
            },
            getProductValueSelect(propId){ //get product value
                let ret = 0;
                this.product.property_values.forEach(function(entry) {
                    if (propId == entry.parameter_id) {
                        ret = entry.parameter_value_id;
                        return ret;
                    }
                })
                return ret;
            },
            getProductValueCheckbox(propId){
                let ret = [];
                this.product.property_values.forEach(function(entry) {
                    if (propId == entry.parameter_id) {
                        ret.push(entry.parameter_value_id);
                        return ret;
                    }
                })
                return ret;
            },
            getPropValueCheckbox(){

            },
            getPropValueText(){
                let vm = this;
                let defaultVal = [];
                let multilingual = 1;

                 this.category.params.forEach(function (entry, key) {
                     if (entry.property.type == 'text' || entry.property.type == 'textarea') {
                        multilingual = entry.property.multilingual;
                        defaultVal[entry.parameter_id] = vm.getProductValueText(entry.parameter_id, multilingual);
                     }
                 })
                 this.propertiesText = defaultVal;
            },
            getProductValueText(propId, multilingual){ //get product text value
                let vm = this;
                let ret = [''];
                let retInfo = [];

                this.product.property_values.forEach(function(entry, index) {
                    if (propId === entry.parameter_id) {
                        if (multilingual == 1) {
                            vm.langs.forEach(function(item, key){
                                if (entry.translations[key] != undefined) {
                                    if (item.id == entry.translations[key].lang_id) {
                                        retInfo[key] = entry.translations[key].value;
                                    }else{
                                        retInfo[key] = '';
                                    }
                                }else{
                                    retInfo[key] = '';
                                }
                            })
                        }else{
                            if (entry.translations[0] != undefined) {
                                retInfo[0] = entry.translations[0].value;
                            }else {
                                retInfo[0] = '';
                            }
                        }
                        return retInfo;
                    }else{
                        if (multilingual == 1) {
                            vm.langs.forEach(function(item, key){
                                ret[key] = '';
                            })
                        }else{
                            ret[0] = '';
                        }
                        return ret;
                    }
                })

                if (retInfo.length > 0) {
                    return retInfo;
                }
                return ret;
            },

            strCut(text){
                return text.length > 15 ? text.substring(0, 15) + '...' : text;
            },
            prepareFields() { //image prepare field
                if (this.attachments.length > 0) {
                    for (var i = 0; i < this.attachments.length; i++) {
                        let attachment = this.attachments[i];
                        this.data.append('attachments[]', attachment);
                    }
                    this.data.append('product_id', this.product.id);
                }
            },
            uploadFieldChange(e) {
                var name = e.target.name;
                var files = e.target.files || e.dataTransfer.files;

                if (name.length > 0) {
                    $('.svbtn').removeClass('btn-warning');
                    $('.svbtn').addClass('btn-primary');
                    $('#' + name).removeClass('btn-primary');
                    $('#' + name).addClass('btn-warning');
                }

                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }

                document.getElementById("video-attachments").value = [];
                document.getElementById("attachments").value = [];
            },
            submit() {
                this.loading = true;
                this.prepareFields();
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                axios.post('/back/auto-upload-upload-images', this.data, config)
                .then(function (response) {
                    this.updateImagesList();
                    this.updateImagesListFB();
                    if (response.status === 200) {
                        console.log('Successfull Upload');
                        this.resetData();
                    } else {
                        console.log('Unsuccessful Upload');
                    }

                    this.resetData();

                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
            },
            submitFB(){
                this.loading = true;
                this.prepareFields();
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                axios.post('/back/auto-upload-upload-imagesFB', this.data, config)
                .then(function (response) {
                    this.updateImagesListFB();
                    if (response.data.success) {
                        console.log('Successfull Upload');
                        this.resetData();
                    } else {
                        console.log('Unsuccessful Upload');
                    }
                    this.resetData();

                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
            },
            saveSets(setId){
                this.loading = true;
                axios.post('/back/auto-upload-save-sets', {sets: this.setsProduct, product_id: this.product.id, set_id: setId})
                .then(function (response) {
                    this.loading = false;
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                    this.loading = false;
                });
            },
            saveCategs(categId){
                this.loading = true;
                axios.post('/back/auto-upload-save-categs', {categs: this.categsProduct, product_id: this.product.id, categ_id: categId})
                .then(function (response) {
                    this.loading = false;
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                    this.loading = false;
                });
            },
            uploadSetImage(setId){
                $('.svbtn').removeClass('btn-warning');
                $('.svbtn').addClass('btn-primary');

                this.loading = true;
                this.prepareFields();
                this.data.append('set_id', setId);

                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                axios.post('/back/auto-upload-set-image-upload', this.data, config)
                    .then(response => {
                        this.setsAll = response.data.sets;
                        this.product = response.data.product;
                        this.resetData();
                        this.loading = false;
                    })
                    .catch(e => {
                        this.loading = false;
                        console.log('error load products');
                    })
            },
            removeSetImage(setId){
                if (confirm("Do you really want to delete image?")) {
                    $('.svbtn').removeClass('btn-warning');
                    $('.svbtn').addClass('btn-primary');

                    this.loading = true;

                    axios.post('/back/auto-upload-set-image-remove', {set_id: setId, product_id: this.product.id})
                        .then(response => {
                            this.setsAll = response.data.sets;
                            this.product = response.data.product;
                            this.loading = false;
                        })
                        .catch(e => {
                            this.loading = false;
                            console.log('error load remove set image');
                        })
                }
            },
            uploadVideo(){
                this.prepareFields();
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                this.loading = true;
                axios.post('/back/auto-upload-upload-video', this.data, config)
                    .then(response => {
                        this.video = response.data;
                        this.resetData();
                        this.loading = false;
                    })
                    .catch(e => {
                        this.loading = false;
                        console.log('error load products');
                    })
                    this.loading = false;
            },
            getSetImage(setId){
                let ret = false;
                this.product.set_images.forEach(function(entry){
                    if(setId == entry.set_id){
                        ret = entry.image;
                        return ret;
                    }
                })
                return ret;
            },
            resetData() {
                this.data = new FormData();
                this.attachments = [];
            },
            updateImagesList(){
                axios.post('/back/auto-upload-get-images', {product_id: this.product.id})
                    .then(response => {
                        this.images = response.data;
                        this.loading = false;
                    })
                    .catch(e => {
                        this.loading = false;
                        console.log('error load products');
                    })
            },
            updateImagesListFB(){
                axios.post('/back/auto-upload-get-images-fb', {product_id: this.product.id})
                    .then(response => {
                        this.imagesFB = response.data;
                        this.loading = false;
                    })
                    .catch(e => {
                        this.loading = false;
                        console.log('error load products');
                    })
            },
            removeImage(id){
                if (confirm("Do you really want to delete this image?")) {
                    this.loading = true;
                    axios.post('/back/auto-upload-remove-image', {product_id: this.product.id, id : id})
                        .then(response => {
                            this.images = response.data;
                            this.loading = false;
                        }).catch(e => {
                            this.loading = false;
                        })
                }
            },
            removeImageFB(id){
                if (confirm("Do you really want to delete this image?")) {
                    this.loading = true;
                    axios.post('/back/auto-upload-remove-image-fb', {product_id: this.product.id, id : id})
                        .then(response => {
                            this.imagesFB = response.data;
                            this.loading = false;
                        }).catch(e => {
                            this.loading = false;
                        })
                }
            },
            mainImage(id){
                this.loading = true;
                axios.post('/back/auto-upload-main-image', {product_id: this.product.id, id : id})
                    .then(response => {
                        this.images = response.data;
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            firstImage(id, sort){
                this.loading = true;
                axios.post('/back/auto-upload-first-image', {product_id: this.product.id, id : id, sort: sort})
                    .then(response => {
                        this.images = response.data.images;
                        this.imagesFB = response.data.imagesFB;
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            getFormSubproducts(submitEvent){
                 this.loading = true;
                 axios.post('/back/auto-upload-edit-subproducts', {
                                            product_id: this.product.id,
                                            subproducts : this.subproductFields,
                                            subproductPrices: this.subproductPrices,
                                            stocks: this.stocks,
                                            ean_code: this.ean_code,
                                            code: this.code,
                                        })
                     .then(response => {
                         this.subproducts = response.data;
                         this.loading = false;
                     }).catch(e => {
                         this.loading = false;
                     })
            },
            inheritProduct(){
                if (confirm("Do you really want to inherit product fields?")) {
                    this.loading = true;
                    axios.post('/back/auto-upload-edit-subproducts', {
                                               product_id: this.product.id,
                                               subproducts : this.subproductFields,
                                               subproductPrices: this.subproductPrices,
                                               stocks: this.stocks,
                                               ean_code: this.ean_code,
                                               code: this.code,
                                           })
                        .then(response => {
                            this.subproducts = response.data;
                            axios.post('/back/auto-upload-inherit-subproducts', {product_id: this.product.id})
                                .then(response => {
                                    this.warehouses = response.data.warehouses,
                                    this.warehousesStocks = response.data.warehousesStocks,
                                    this.subproducts = response.data.subproducts;
                                    this.loading = false;
                                }).catch(e => {
                                    this.loading = false;
                                })
                        }).catch(e => {
                            this.loading = false;
                        })
                }
            },
            generateNewSet(collectionId){
                this.loading = true;
                axios.post('/back/auto-upload-generate-new-set', {product_id: this.product.id, collection_id: collectionId})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            addBrandToProduct(brandId){
                this.loading = true;
                axios.post('/back/auto-upload-add-brand-to-product', {product_id: this.product.id, brand_id: brandId})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            setSimilarProducts(categoryId){
                this.loading = true;
                axios.post('/back/auto-upload-set-similar-products', {product_id: this.product.id, category_id: categoryId})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            setSimilarAll(e){
                let categories = this.categories;
                $('.similar-categories').prop('checked', true);

                this.loading = true;
                axios.post('/back/auto-upload-set-similar-all-products', {product_id: this.product.id, categories_id: categories})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            unsetSimilarAll(e){
                let categories = [];
                $('.similar-categories').prop('checked', false);

                this.loading = true;
                axios.post('/back/auto-upload-set-similar-all-products', {product_id: this.product.id, categories_id: categories})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            setHit(){
                this.loading = true;
                axios.post('/back/auto-upload-set-hit-products', {product_id: this.product.id})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            setRecomended(){
                this.loading = true;
                axios.post('/back/auto-upload-set-recomended-products', {product_id: this.product.id})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            removeVideo(){
                if (confirm("Do you really want to delete?")) {
                this.loading = true;
                axios.post('/back/auto-upload-remove-video', {product_id: this.product.id})
                    .then(response => {
                        this.loading = false;
                        this.video = false;
                    }).catch(e => {
                        this.loading = false;
                    })

                }
            },
            changeDependeblePrice(){
                if (confirm("Do you really want to change dependable status?")) {
                    this.loading = true;
                    axios.post('/back/auto-upload-change-dependable-price', {product_id: this.product.id, prices: this.currencyPrices})
                        .then(response => {
                            this.loading = false;
                            this.prices = response.data.prices;
                        }).catch(e => {
                            this.loading = false;
                        })
                }
            },
            savePrices(){
                this.loading = true;
                axios.post('/back/auto-upload-save-prices', {product_id: this.product.id, prices: this.currencyPrices, b2bPrices: this.b2bPrices, discount: this.discount})
                    .then(response => {
                        this.loading = false;
                        this.prices = response.data.product_prices.prices;
                        this.dillerPrices = response.data.diller_prices;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            changeDependableStatut(subproductId){
                if (confirm("Do you really want to change dependable status?")) {
                    this.loading = true;
                    axios.post('/back/auto-upload-change-dependable-status', {subproduct_id: subproductId, product_id: this.product.id, subproductPrices: this.subproductPrices})
                        .then(response => {
                            this.loading = false;
                            this.subproducts = response.data;
                        }).catch(e => {
                            this.loading = false;
                        })
                }
            },
            getMaterials(){
                this.materials = [];
                this.loading = true;
                axios.post('/back/auto-upload-get-materials', {product_id: this.product.id})
                    .then(response => {
                        this.loading = false;
                        this.materials = response.data.materials;
                        this.checkedMaterials = response.data.checkedMaterials;
                        this.setCheckedMaterials();
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            setCheckedMaterials(){
                let arr = [];
                let wm = this;

                this.materials.forEach(function(entry){
                    if (wm.checkedMaterials.includes(entry.id)) {
                        arr[entry.id] = 1;
                    }else{
                        arr[entry.id] = 0;
                    }
                });

                this.materialsModel = arr;
            },
            addMaterialToProduct(id){
                this.loading = true;
                axios.post('/back/auto-upload-add-materials', {product_id: this.product.id, material_id: id})
                    .then(response => {
                        this.loading = false;
                        // this.materials = response.data.materials;
                        // this.checkedMaterials = response.data.checkedMaterials;
                        // this.setCheckedMaterials();
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            changeProductLocationLoungewear(){
                this.loading = true;
                axios.post('/back/auto-upload-change-com-status', {product_id: this.product.id, product_loungewear: this.product.loungewear})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            changeProductLocationJewelry(){
                this.loading = true;
                axios.post('/back/auto-upload-change-md-status', {product_id: this.product.id, product_jewelry: this.product.Jewelry})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            changeProductStatus(){
                this.loading = true;
                axios.post('/back/auto-upload-change-active-status', {product_id: this.product.id, product_jewelry: this.product.active})
                    .then(response => {
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            updateSubproducts(){
                this.loading = true;
                axios.post('/back/auto-upload-update-subproducts', {product_id: this.product.id})
                    .then(response => {
                        this.subproducts = response.data.product.subproducts,
                        this.warehouses = response.data.warehouses,
                        this.warehousesStocks = response.data.warehousesStocks,
                        this.warehousesProductStocks = response.data.warehousesProductStocks,
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            },
            changeCategory(){
                this.loading = true;
                axios.post('/back/auto-upload-change-category', {product_id: this.product.id, category_id: this.categId})
                    .then(response => {
                        bus.$emit('cancelSearch');
                        this.loading = false;
                    }).catch(e => {
                        this.loading = false;
                    })
            }
        },
    }
</script>

<style>
    .setImage{
        position: relative;
    }
    .setImage img{
        position: absolute;
        height: 80px;
        right: 15px;
        top: -15px;
    }
</style>
