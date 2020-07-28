<template>
    <div class="row mt-4" v-cloak v-if="count > 0">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ title }}</h2>
                    </div>
                    <hr>
                    <!--Key adds an ordering hint
                        See docs for more info: https://vuejs.org/v2/api/#v-for
                    -->
                    <answer v-for="answer in answers" :answer="answer" :key="answer.id"></answer>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info m-4" v-else>
        <p class="card-body pb-1">There are currently no answers to this question. Be the first to provide one!</p>
    </div>
</template>

<script>
    import Answer from './Answer';

    export default {
        props: ['answers', 'count'],

        computed: {
            title() {
                return `${this.count} ${this.count > 1 ? 'Answers': 'Answer'}`;
            }
        },

        components: {
            Answer
        }
    }
</script>
