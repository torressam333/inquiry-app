<template>
    <div class="row align-items-center">
        <div class="col">
<<<<<<< HEAD
            <button class="btn btn-outline-info"
                    :disabled="isFirst"
                    @click="prev">Newer</button>
        </div>
        <div class="col text-center">
            {{pagesInfo}}
        </div>
        <div class="col text-right">
            <button class="btn btn-outline-info"
                    :disabled="isLast"
                    @click="next">Older</button>
=======
            <button class="btn btn-outline-info" :disabled="isFirst" @click="prev">Newer</button>
        </div>
        <div class="col">
            <div class="col text-center">
                <div class="col text-center">{{pagesInfo}}</div>
            </div>
        </div>
        <div class="col">
            <div class="col text-right">
                <button class="btn btn-outline-info" :disabled="isLast" @click="next">Older</button>
            </div>
>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
        </div>
    </div>
</template>

<script>
<<<<<<< HEAD
export default {
    props: ['meta', 'links'],
    computed: {
        pagesInfo() {
            return `Page ${this.meta.current_page} of ${this.meta.last_page}`
        },
        isFirst() {
            return this.meta.current_page === 1;
        },
        isLast() {
            return this.meta.current_page === this.meta.last_page;
        }
    },
    methods: {
        switchPage() {
            $router.push({
                name: 'questions',
                query: {
                    page: this.meta.current_page
                },
            });
        },
        prev() {
            if (!this.isFirst) {
                this.meta.current_page--;
            }
            this.switchPage();
        },
        next() {
            if (!this.isLast) {
                this.meta.current_page++;
            }
            this.switchPage();
        }
    }
}
=======
    export default {
        props: ['links', 'meta'],
        computed: {
            pagesInfo() {
                return `Page ${this.meta.current_page} of ${this.meta.last_page}`
            },
            isFirst() {
                return this.meta.current_page === 1;
            },
            isLast() {
                return this.meta.current_page === this.meta.last_page;
            }
        },
        methods: {
            switchPage() {
                //Define routing for where pagination should take you
                this.$router.push({
                    name: 'questions',
                    query: {
                        page: this.meta.current_page
                    },
                });
            },
            prev() {
                if (!this.isFirst) {
                    this.meta.current_page--;
                }
                this.switchPage();
            },
            next() {
                if(!this.isLast){
                    this.meta.current_page++;
                }
                this.switchPage();
            }
        }
    }
>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
</script>
