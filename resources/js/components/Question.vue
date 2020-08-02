<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <form class="card-body" v-if="editing" @submit.prevent="update">
                    <div class="card-title">
                        <label>
                            <input type="text" class="form-control form-control-lg" v-model="title">
                        </label>
                    </div>
                    <hr>
                    <div class="media">
                        <vote :model="question" name="question"></vote>
                        <div class="media-body">
                            <div v-html="bodyHtml">

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <a v-if="authorize('modify', question)" @click.prevent="edit"
                                           class="btn btn-sm btn-outline-info">Edit</a>
                                        <button v-if="authorize('modify', question)" @click="destroy"
                                                class="btn btn-sm btn-outline-danger">Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info v-bind:model="question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ title }}</h1>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Back to
                                    all Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <textarea rows="10" v-model="body" class="form-control" required></textarea>
                            </div>
                            <button class="btn btn-outline-primary" type="submit" :disabled="isInvalid">Update</button>
                            <button class="btn btn-outline-danger" type="button" @click="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        data() {
            return {
                //Set question properties
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                editing: false,
                id: this.question.id,
                //property to hold the question before modification
                beforeEditCache: {}
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10 || this.title.length < 9
            },
            endpoint() {
                return `/questions/${this.id}`;
            }
        },
        methods: {
            edit() {
                //Store old question in cache
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
                this.editing = true;
            },
            cancel() {
                //Before canceling, restore original title/body
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
                this.editing = false;
            },

        }
    }
</script>
