<template>
    <div>
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
                        <answer v-on:deleted="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id"></answer>

                        <div class="text-center mt-3" v-if="nextUrl">
                            <button @click="fetch(nextUrl)" class="btn btn-outline-secondary">Load More Answers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-info m-4" v-else>
            <p class="card-body pb-1">There are currently no answers to this question. Be the first to provide one!</p>
        </div>
        <!--New answer component-->
        <new-answer @created="add" :question-id="question.id"></new-answer>
    </div>

</template>

<script>
    import Answer from './Answer';
    import NewAnswer from "./NewAnswer";

    export default {
        props: ['question'],

        data() {
            return {
                questionId: this.question.id,
                //Hold answer count from question instance
                count: this.question.answers_count,
                //Store all answers
                answers: [],
                nextUrl: null,
            }
        },

        created() {
            //Used for fetching back end api data
            this.fetch(`/questions/${this.questionId}/answers`);
        },

        methods: {
            add(answer) {
                this.answers.push(answer);
                this.count++;
            },
            fetch(endpoint) {
                axios.get(endpoint)
                    //Destructure res and bring back data object
                    .then(({data}) => {
                        //Adds answer to page
                        this.answers.push(...data.data);
                        this.nextUrl = data.next_page_url;
                    })
            },
            remove(index) {
                //Delete answer from answers array
                this.answers.splice(index, 1);
                this.count--;
            }
        },

        computed: {
            title() {
                return `${this.count} ${this.count > 1 ? 'Answers' : 'Answer'}`;
            }
        },

        components: {
            Answer,
            NewAnswer,
        }
    }
</script>
