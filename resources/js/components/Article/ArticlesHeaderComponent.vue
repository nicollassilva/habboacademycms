<template>
    <div class="content-title">
        <div class="icon" style="background-image: url('/images/content-icons/news.png')"></div>
        <div class="data">
            <div class="principal">Portal de Notícias</div>
            <div class="description">Aqui você encontra tudo sob o ramo de notícias!</div>
        </div>
        <div class="action-buttons">
            <div class="search">
                <input type="text" @keyup.enter="emitSearchValue" v-model="search" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                <i class="fas fa-search customTransition"></i>
            </div>
            <div class="pagination">
                <div class="btn-pagination d-flex justify-content-center align-items-center">
                    <i class="fas fa-ellipsis-v"></i>
                    <div class="dropdown-pagination" v-if="categories.length">
                        <button value="0">Todas</button>
                        <button
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                            @click="selectCategory(category)"
                        >
                            {{ category.name }}
                        </button>
                    </div>
                </div>
                <button class="btn-pagination" :disabled="disablePreviousButton" @click="previousPage()"><i class="fas fa-chevron-left"></i></button>
                <button class="btn-pagination"><i class="fas fa-sync-alt fa-spin"></i></button>
                <button class="btn-pagination" :disabled="disableNextButton" @click="nextPage()"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "ArticlesHeaderComponent",

    props: {
        currentPage: {
            type: Number,
            default: 1
        },
        lastPage: {
            type: Number,
            default: 1
        },
        loading: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            search: null,
            categories: [],
            selectedCategory: null
        }
    },

    mounted() {
        this.getArticlesCategories()
    },

    computed: {
        disableNextButton() {
            return this.currentPage == this.lastPage
        },

        disablePreviousButton() {
            return this.currentPage <= 1
        }
    },

    methods: {
        getArticlesCategories() {
            this.$http.get('api/v1/articles/categories')
                .then(({ data }) => {
                    if(!data.length) return

                    this.categories = data
                })
        },

        emitSearchValue() {
            this.$emit('search', this.search)
        },

        nextPage() {
            if(this.loading || this.currentPage >= this.lastPage) return

            this.$emit('nextPage', ++this.currentPage)
        },

        previousPage() {
            if(this.loading || this.currentPage <= 1) return

            this.$emit('previousPage', --this.currentPage)
        },

        selectCategory(category) {
            if(this.selectedCategory && (this.selectedCategory.id == category.id)) return

            this.selectedCategory = category
            this.$emit('selectedCategory', this.selectedCategory)
        }
    }
}
</script>