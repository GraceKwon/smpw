<template>
    <label>{{ text }}</label>
</template>

<script>
    export default {
        props: {
            text: {
                type: String,
                default: "",
                required: false,
            },
        },
    }
</script>
