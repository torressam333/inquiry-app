<template>
    <div class="row align-items-center">
        <div class="col">
            <button class="btn btn-outline-secondary">Newer</button>
        </div>
        <div class="col">
            <div class="col text-center">
                <div class="col text-center">{{pagesInfo}}</div>
            </div>
        </div>
        <div class="col">
            <div class="col text-right">
                <button class="btn btn-outline-secondary">Older</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['links', 'meta'],
        computed: {
            pagesInfo() {
                return `Page ${this.meta.current_page} of ${this.meta.last_page}`
            }
        }
    }
</script>
