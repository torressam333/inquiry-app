<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>All Questions</h2>
                            <div class="ml-auto">
                                <router-link :to="{ name: 'questions.create' }" class="btn btn-outline-secondary">Ask Question</router-link>
                            </div>
                        </div>

                    </div>
<<<<<<< HEAD
=======

>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
                    <questions></questions>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
<<<<<<< HEAD
import Questions from '../components/Questions.vue';

export default {
    components: {Questions}
=======
import Questions from '../components/Questions.vue'
export default {
    components: { Questions }
>>>>>>> 9c8b63959be976fa5d1ce67670ba54bb76a2dc2e
}
</script>
