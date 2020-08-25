<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>All Questions</h2>
                            <div class="ml-auto">
                                <a href="#" class="btn btn-outline-secondary">Ask
                                    Question</a>
                            </div>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import QuestionExcerpt from "../components/QuestionExcerpt";

    export default {
        components: {QuestionExcerpt},
        data() {
            return {
                //Define property to hold all questions
                questions: []
            }
        },
        mounted() {
            this.fetchQuestions();
        },
        methods: {
            fetchQuestions() {
                axios.get('/questions')
                    .then(({data}) => {
                        //Assign api returned response to questions
                        this.questions = data.data
                    })
            }
        }
    }
</script>
