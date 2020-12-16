<template>
    <div class="alert alert-block" :class="'alert-'+alert.type" v-if="alert.show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ alert.msg }}</strong>
    </div>
</template>

<script>
export default {
    props: {
        alert: {
            type: Object,
            required: true,
        },
    },
}
</script>
