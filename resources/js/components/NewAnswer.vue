<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea class="form-control" rows="7" required v-model="body" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-md btn-outline-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['questionId'],
        data() {
            return {
                body: ''
            }
        },
        computed: {
            isInvalid() {
                //check if user is signed in or body length
                return !this.signedIn || this.body.length < 10;
            }
        },
        methods: {
            create() {
                //Endpoint for adding an answer to a question
                axios.post(`/questions/${this.questionId}/answers`, {
                    //from payload
                    body: this.body
                })
                .catch(error => {
                    this.$toast.error(error.response.data.message, "Error");
                })
                .then(({data}) => {
                    this.$toast.success(data.message, "Success");
                    //Reset text area
                    this.body = '';
                    //Add answer to answers array for immediate UI update
                    this.$emit('created', data.answer);
                })
            }
        },
    }
</script>
