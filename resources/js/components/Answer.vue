<script>
    export default {
        props: ['answer'],
        data() {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null,
            }
        },
        methods: {
            edit() {
                this.beforeEditCache = this.body;
                this.editing = true;
            },
            cancel() {
                this.body = this.beforeEditCache;
                this.editing = false;
            },
            update() {
                //Send request to server using axios
                //"this" in this context refers to the Answer vue component
                //This method returns a promise (hence .then and .catch)
                axios.patch(this.endpoint, {
                    //Data being patched (updated)
                    body: this.body
                })
                    .then(res => {
                        this.editing = false;
                        this.bodyHtml = res.data.body_html;
                        alert(res.data.message)
                    })
                    .catch(err => {
                        alert(err.response.data.message);
                    });
            },
            destroy() {
                if(confirm('Are you sure?')){
                    axios.delete(this.endpoint)
                    .then(res => {
                       $(this.$el).fadeOut(750, () => {
                           alert(res.data.message)
                       })
                    });
                }
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 7;
            },
            endpoint() {
              return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>
