import Prism from 'prismjs';

export default {
    methods: {
        highlight() {
            const el = this.$refs.bodyHtml;
            //Ensure method is called if el is defined
            if(el) Prism.highlightAllUnder(el);
        }
    }
}
