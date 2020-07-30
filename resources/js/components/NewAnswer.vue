<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                    </div>
                    <hr>
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="10" required v-model="body" name="body"></textarea>
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
    }
</script>
