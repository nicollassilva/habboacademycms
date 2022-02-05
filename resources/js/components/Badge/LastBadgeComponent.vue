<template>
    <div>
        <div class="top-bar">
            <div class="default-title mini border-0 customTransition">
                <b class="customTransition">
                    <i class="fas fa-certificate mr-2"></i>
                    Últimos
                </b>
                Emblemas
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
        <div class="box-content" v-if="badgePaginator.data.length || loading">
            <template v-if="!loading">
                <div 
                    v-for="badge in badgePaginator.data"
                    :key="badge.id"
                    class="content animated bounceIn"
                    :style="`background-image: url('${badge.image_path}')`"
                    data-toggle="tooltip"
                    :title="`<b>Código:</b> ${badge.code}<br /><b>Título:</b> ${badge.title}<br /><b>Raridade:</b> ${badge.rarity}`"
                >
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
    name: "LastBadgeComponent",

    data() {
        return {
            search: '',
            loading: false,
            boxAnimate: null,
            badgePaginator: { data: [] },
        }
    },

    mounted() {
        this.setEntryAnimation()
        this.getLastBadges()
    },

    computed: {
        disableNextButton() {
            if(!this.badgePaginator.data.length) {
                return true
            }

            if(!this.badgePaginator.last_page) {
                return true
            }

            if(this.badgePaginator.last_page <= 1) {
                return true
            }

            return this.badgePaginator.current_page == this.badgePaginator.last_page
        },

        disablePreviousButton() {
            if(!this.badgePaginator.data.length) {
                return true
            }

            if(!this.badgePaginator.current_page) {
                return true
            }

            return this.badgePaginator.current_page <= 1
        }
    },

    methods: {
        nextPage() {
            if(this.loading) return

            let currentPage = this.badgePaginator.current_page

            if(!currentPage || currentPage >= this.badgePaginator.last_page) return

            this.setExitAnimation()
            setTimeout(() => this.getLastBadges(++currentPage), 1000)
        },

        previousPage() {
            if(this.loading) return

            let currentPage = this.badgePaginator.current_page

            if(!currentPage || currentPage <= 1) return

            this.setExitAnimation()
            setTimeout(() => this.getLastBadges(--currentPage), 1000)
        },

        setExitAnimation() {
            this.boxAnimate = 'bounceOut'
        },

        firstPage() {
            this.setExitAnimation()
            setTimeout(() => this.getLastBadges(1), 1000)
        },
        
        getLastBadges(page = 1) {
            if(!Number.isInteger(page) || this.loading) return

            this.loading = true

            this.$http.get(this.getFetchUrl(page))
                .then(({ data }) => {
                    if(data.data) {
                        this.setEntryAnimation()
                        this.badgePaginator = data

                        setTimeout(_ => this.loading = false, 1000)
                    }
                })
                .catch(() => {})
        },

        setEntryAnimation() {
            this.boxAnimate = 'bounceIn'
        },

        getFetchUrl(page) {
            return this.search
                ? `api/v1/badges/latest?page=${page}&search=${this.search}`
                : `api/v1/badges/latest?page=${page}`
        },
    }
}
</script>