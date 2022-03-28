<template>
    <section class="section-news mt-0">
        <articles-header-component />
        <div class="box-content">
            <template v-if="articles.data.length">
                <div class="box-new"
                    v-for="article in articles.data"
                    :key="article.id"
                >
                    <div class="data">
                        <div class="statistics">
                            <i class="fas fa-comment"></i> 0 <i class="fas fa-heart ml-1"></i> 0
                        </div>
                        <div class="statistics" style="width: 60%">
                            <i class="fas fa-clock mr-1"></i>
                            {{ article.stringTime }}
                        </div>
                    </div>
                    <div class="image" :style="`background-image: url('${article.image_path}')`"></div>
                    <div class="title" style="height: 35px">
                        <a :href="article.route">{{ article.title }}</a>
                    </div>
                    <div class="footer mt-2">
                        <div class="category text-truncate">{{ article.category.name }}</div>
                        <div class="author">
                            <div class="avatar" 
                                    style="background-image: url('')"></div>
                                <a href="">{{ article.user.username }}</a>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <img src="/images/habbo_loader.gif" alt="loader" />
                </div>
            </template>
        </div>
    </section>
</template>
<script>
import ArticlesHeaderComponent from './ArticlesHeaderComponent'

export default {
    name: "ArticlesComponent",

    components: { ArticlesHeaderComponent },

    data() {
        return {
            articles: { data: [] },
            loading: false,
            fetchUrl: null
        }
    },

    mounted() {
        this.getArticles()
    },

    methods: {
        getArticles(page = 1) {
            if(this.loading) return

            this.loading = true

            this.$http.get('api/v1/articles?page=1')
                .then(({ data }) => {
                    setTimeout(() => this.loading = false, 1000)

                    if(data.data.length) {
                        this.articles = data
                    }
                })
                .catch(() => {})
        },

        setFetchUrl(category = null, search = null) {
            let defaultUrl = 'api/v1/articles?page='
        },

        getArticleImage(url) {
            if(url.indexOf('articles') > 0) {
                return `http://localhost/storage/${url}`
            }

            return url
        }
    }
}
</script>