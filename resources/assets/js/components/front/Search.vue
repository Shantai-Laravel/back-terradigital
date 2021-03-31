<template>
    <div class="search-wrapp">

        <div class="search-wrapp">
          <div class="search-block">
            <input type="text" v-model="search" @keyup="findProduct" autocomplete="nope">
          </div>
            <ul>
              <li class="search-item" v-for="product in products">
                <a :href="product.url" class="search-link">
                  <div class="search-image">
                      <img :src="product.image" alt="">
                  </div>
                  <p class="title-search">{{ product.title }}</p>
                </a>
              </li>
                <li class="search-item" v-for="page in pages">
                    <a :href="page.url" class="search-link_">
                        <div class="search-image"></div>
                        <p class="title-search">{{ page.title }}</p>
                    </a>
                </li>
                <li class="search-item" v-for="blog in blogs">
                    <a :href="blog.url" class="search-link_">
                        <div class="search-image"></div>
                        <p class="title-search">{{ blog.title }}</p>
                    </a>
                </li>
                <li class="search-item" v-for="cat in blogCat">
                    <a :href="cat.url" class="search-link_">
                        <div class="search-image"></div>
                        <p class="title-search">{{ cat.title }}</p>
                    </a>
                </li>
                <li class="search-item" v-for="faq in faqs">
                    <a :href="faq.url" class="search-link_">
                        <div class="search-image"></div>
                        <p class="title-search">{{ faq.title }}</p>
                    </a>
                </li>
            </ul>
          </div>
    </div>
</template>

<script>
    import { bus } from "../../app_mobile";

    export default {
        data() {
            return {
                lodaing: false,
                search: "",
                products: [],
                pages: [],
                blogs: [],
                blogCat: [],
                faqs: [],
            };
        },
        mounted() {
        },
        methods: {
            findProduct(){
                if (this.search.length == 0) {
                    this.products = []
                }
                if (this.search.length > 2) {
                    this.loading = true;
                    axios.post('/'+ this.$lang + '/search', {
                            search: this.search
                        })
                        .then(response => {
                            this.products = response.data.products
                            this.pages = response.data.pages
                            this.blogs = response.data.blogs
                            this.blogCat = response.data.blogCat
                            this.faqs = response.data.faqs
                            this.loading = false;
                        })
                        .catch(e => {
                          this.loading = false;
                          console.log('loading search error.');
                        })
                }
            }
        }
    };
</script>


<style>
    .title-search{
        color: rgb(54, 54, 54) !important;
    }
</style>
