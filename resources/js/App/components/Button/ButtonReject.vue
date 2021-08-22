<template>
    <b-button type="submit" variant="primary" class="btn-reject">
        <b-icon icon="x" scale="1.4" aria-hidden="true"></b-icon>
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
    .btn-reject{
        padding: 8px 45px;
        margin-top: 15px;
        color: #FF3B30;
        border: none;
        background: rgb(255, 236, 235);
        border-radius: 9.27273px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .btn-reject:hover{
        background: #FF3B30;
        color: #ffffff;
    }
</style>
