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

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-secondary">Load More Answers</button>
                    </div>
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
        props: ['question'],

        data() {
            return {
                questionId: this.question.id,
                //Hold answer count from question instance
                count: this.question.answers_count,
                //Store all answers
                answers: [],
            }
        },

        created() {
            //Used for fetching back end api data
            this.fetch(`/questions/${this.questionId}/answers`);
        },

        methods: {
            fetch(endpoint) {
                axios.get(endpoint)
                    //Destructure res and bring back data object
                    .then(({data}) => {
                        //Adds answer to page
                       this.answers.push(...data.data);
                    })
            }
        },

        computed: {
            title() {
                return `${this.count} ${this.count > 1 ? 'Answers' : 'Answer'}`;
            }
        },

        components: {
            Answer
        }
    }
</script>
