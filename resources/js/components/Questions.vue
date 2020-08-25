<template>
    <div>
        <div class="card-body">
            <div v-if="questions.length">
                <question-excerpt v-for="question in questions" :question="question"
                                  :key="question.id"></question-excerpt>
            </div>
            <div v-else class="alert alert-info">
                <h6><strong>There are no questions available. Be the first to add one!</strong></h6>
            </div>
            <!--Pagination goes here-->
        </div>
        <div class="card-footer">
            <pagination v-bind:meta="meta" v-bind:links="links"></pagination>
        </div>
    </div>
</template>

<script>
    import QuestionExcerpt from "./QuestionExcerpt";
    import Pagination from "./Pagination";

    export default {
        components: {QuestionExcerpt, Pagination},
        data() {
            return {
                //Define property to hold all questions
                questions: [],
                meta: {},
                links: {}
            }
        },
        mounted() {
            this.fetchQuestions();
        },
        methods: {
            fetchQuestions() {
                axios.get('/questions', {params: this.$route.query})
                    .then(({data}) => {
                        //Assign api returned response to questions
                        this.questions = data.data;
                        this.meta = data.meta;
                        this.links = data.links;
                    });
            }
        },
        watch: {
            "$route": 'fetchQuestions'
        }
    }
</script>
