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
<<<<<<< HEAD
            <pagination
                :meta="meta"
                :links="links"
            ></pagination>
=======
            <pagination v-bind:meta="meta" v-bind:links="links"></pagination>
>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
        </div>
    </div>
</template>

<script>
<<<<<<< HEAD
import QuestionExcerpt from "../components/QuestionExcerpt";
import Pagination from './Pagination';

export default {
    components: {QuestionExcerpt, Pagination},
    data() {
        return {
            //Define property to hold all questions
            questions: [],
            meta: {},
            links: {},
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
                    this.questions = data.data;
                    this.meta = data.meta;
                    this.links = data.links;
                })
        }
    }
}
=======
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
>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
</script>
