<template>
    <div>
        <div class="top-bar">
            <div class="default-title mini border-0">
                <b class="customTransition">
                    <i class="fas fa-coins mr-2"></i>
                    Últimos
                </b>
                Valores
            </div>
            <div class="action-buttons">
                <div class="search">
                    <input @keyup.enter="firstPage()" type="text" v-model="search" placeholder="Pesquise aqui..." name="search" autocomplete="off">
                    <i class="fas fa-search customTransition mirror fa-flip-horizontal"></i>
                </div>
                <div class="pagination">
                    <button class="btn-pagination" :disabled="loading || disablePreviousButton" @click="previousPage()"><i class="fas fa-chevron-left"></i></button>
                    <button class="btn-pagination" :disabled="loading || disableNextButton" @click="nextPage()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <div class="box-content" v-if="furniPaginator.data.length || loading">
            <template v-if="!loading">
                <div 
                    v-for="furni in furniPaginator.data"
                    :key="furni.id"
                    :class="['content animated bounceIn', furni.state]"
                    :style="`background-image: url('/storage/${furni.icon_path}')`"
                    data-toggle="tooltip"
                    :title="`<b>Nome:</b> ${furni.name}<br /><b>Preço:</b> ${furni.price} ${furni.price_type}`"
                >
                    <i v-if="furni.state != 'regular'" :class="['fas', { 'fa-chevron-up up': furni.state == 'up', 'fa-chevron-down down': furni.state == 'down' }]"></i>
                </div>
            </template>
            <template v-else>
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <img src="/images/habbo_loader.gif" alt="loader" />
                </div>
            </template>
        </div>
    </div>
</template>
<script>
export default {
    name: "FurniValueComponent",

    data() {
        return {
            furniPaginator: { data: [] },
            loading: false,
            search: ''
        }
    },

    created() {
        this.getFurnis()
    },

    computed: {
        disableNextButton() {
            if(!this.furniPaginator.data.length) {
                return true
            }

            if(!this.furniPaginator.last_page) {
                return true
            }

            if(this.furniPaginator.last_page <= 1) {
                return true
            }

            return this.furniPaginator.current_page == this.furniPaginator.last_page
        },

        disablePreviousButton() {
            if(!this.furniPaginator.data.length) {
                return true
            }

            if(!this.furniPaginator.current_page) {
                return true
            }

            return this.furniPaginator.current_page <= 1
        }
    },

    methods: {
        getFurnis(page = 1, search = null) {
            if(!Number.isInteger(page) || this.loading) return

            this.loading = true

            this.$http.get(this.getApiUrl(page))
                .then(({ data }) => {
                    if(data.data) {
                        this.furniPaginator = data

                        setTimeout(_ => this.loading = false, 1000)
                    }
                })
        },

        getApiUrl(page) {
            return this.search
                ? `api/v1/furnis/values?page=${page}&search=${this.search}`
                : `api/v1/furnis/values?page=${page}`
        },

        nextPage() {
            if(this.loading) return

            let currentPage = this.furniPaginator.current_page

            if(!currentPage || currentPage >= this.furniPaginator.last_page) return

            this.getFurnis(++currentPage)
        },

        previousPage() {
            if(this.loading) return

            let currentPage = this.furniPaginator.current_page

            if(!currentPage || currentPage <= 1) return

            this.getFurnis(--currentPage)
        },

        firstPage() {
            return this.getFurnis(1)
        },

        lastPage() {
            return this.getFurnis(this.furniPaginator.last_page)
        }
    }
}
</script>