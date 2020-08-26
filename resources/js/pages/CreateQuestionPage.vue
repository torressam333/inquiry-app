<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask A Question</h2>
                            <div class="ml-auto">
                                <router-link :to="{name: 'questions'}" class="btn btn-outline-info">
                                    Back to all questions
                                </router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                       <question-form></question-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import QuestionForm from '../components/QuestionForm';

    export default {
        components: {QuestionForm},

    }
</script>
