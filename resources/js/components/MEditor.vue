<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Preview</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <slot></slot>
            <div>Preview...</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['body'],

    }
</script>
