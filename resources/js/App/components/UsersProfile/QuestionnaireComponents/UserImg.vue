<template>
    <div class="col-12 col-md-4 col-lg-4 float-left">
        <div class="user-profile__img">
            <img
                class="user-profile__img-user"
                :src="url_img"
                alt="img-profile"
                v-cloak
            >
        </div>
    </div>
</template>

<script>
export default {
    name: "UserImg",
    props: ['url_img'],
}
</script>

<style lang="scss">
    .user-profile {
        // images
        &__img-user {
            width: 295px;
            height: 295px;
            border-radius: 20px;
            -webkit-box-shadow: -5px 18px 20px 3px rgba(0, 0, 0, 0.29);
            -moz-box-shadow: -5px 18px 20px 3px rgba(0, 0, 0, 0.29);
            box-shadow: -5px 18px 20px 3px rgba(0, 0, 0, 0.29);
        }
    }
</style>
