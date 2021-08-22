<template>
    <b-button type="submit" variant="primary" class="btn-accept">
        <b-icon icon="check" scale="1.3" aria-hidden="true"></b-icon>
        {{ text }}
    </b-button>
</template>

<script>
export default {
    name: "button-accept",
    props: ['text']
}
</script>

<style scoped>
    .btn-accept{
        padding: 8px 45px;
        margin-top: 15px;
        color: #007AFF;
        border: none;
        background: rgba(0, 122, 255, 0.1);
        border-radius: 9.27273px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .btn-accept:hover{
        background: #007AFF;
        color: #ffffff;
    }
</style>
