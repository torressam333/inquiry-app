<template>
    <div class="container">
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>
<script>
    //Register local components
    import Question from "../components/Question.vue";
    import Answers from "../components/Answers.vue";

    export default {
        props: ['question'],
        components: {Question, Answers},
    }
</script>
