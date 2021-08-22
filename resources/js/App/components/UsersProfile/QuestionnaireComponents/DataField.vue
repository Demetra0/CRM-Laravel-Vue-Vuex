<template>
    <div class="user-profile__block">
        <p class="user-profile__item-title" v-cloak>{{ title }}</p>
        <p class="user-profile__item-data" v-cloak>{{ data }}</p>
    </div>
</template>

<script>
export default  {
    name: "DataField",
    props: ['title', 'data'],
}
</script>

<style lang="scss">
.user-profile{
    &__item-title {
        font-weight: normal;
        font-size: 11px;
        color: #ABB2C6;
        margin-bottom: 0;
    }
    &__item-data {
        font-weight: 600;
        font-size: 17px;
        color: #000000;
        line-height: 22px;
        letter-spacing: -0.408px;
    }
}
</style>
