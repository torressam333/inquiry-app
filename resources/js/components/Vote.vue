<template>
        <div class="d-fex flex-column vote-controls">
            <a :title="title('up')"
               class="vote-up" :class="classes">
                <i class="fas fa-caret-up fa-3x"></i>
            </a>
            <span class="votes-count">{{ count }}</span>

            <a :title="title('down')"
               class="vote-down" :class="classes">
                <i class="fas fa-caret-down fa-3x"></i>
            </a>
            <favorite v-if="name==='question'" :question="model"></favorite>
            <accept v-else :answer="model"></accept>

        </div>
</template>

<script>
    //Import favorite and accept answer components here
    import Favorite from './Favorite.vue';
    import Accept from './Accept.vue';

    export default {
        props: ['name', 'model'],
        computed: {
            classes () {
                return this.signedIn ? '' : off;
            }
        },

        components: {
          Favorite: Favorite,
          Accept: Accept
        },
        data() {
            return {
                count: this.model.votes_count,
            }
        },
        methods : {
            title(voteType) {
                let titles = {
                    up: `This ${this.name} is helpful`,
                    down: `This ${this.name} is not helpful`
                };
                //Return title based on argument passed in
                return titles[voteType];
            }
        }
    }
</script>
