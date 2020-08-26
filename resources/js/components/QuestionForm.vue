<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="question-title">Question Title</label>
            <input type="text"
                   name="title"
                   v-model="title"
                   v-bind:class="errorClass('title')">
            <div v-if="errors['title'][0]" class="invalid-feedback">
                <strong>{{errors['title'][0]}}</strong>
            </div>
        </div>
        <div class="form-group">
            <label for="question-body">What is your question?</label>
            <textarea name="body"
                      rows="11"
                      v-model="body"
                      v-bind:class="errorClass('body')">
            </textarea>
            <div v-if="errors['body'][0]" class="invalid-feedback">
                <strong>{{errors['body'][0]}}</strong>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-info btn-lg">{{buttonText}}</button>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return{
                title: '',
                body: '',
                errors: {
                    title: [],
                    body: []
                }
            }
        },
        methods: {
            handleSubmit() {

            },
            errorClass(column) {
                return [
                    'form-control',
                    this.errors[column] && this.errors[column][0] ? 'is-invalid' : '',
                ]
            }
        },
        computed: {
            buttonText() {
                return 'Post Question'
            }
        }
    }
</script>
