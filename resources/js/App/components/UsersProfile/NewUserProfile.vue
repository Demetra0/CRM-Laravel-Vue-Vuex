<template>
    <div class="user-profile__current" v-cloak>

        <UserImg
            :url_img="profileData.picture"
        ></UserImg>

        <UserData
            :name="profileData.name"
            :age="profileData.age"
            :birth_data="profileData.birth_data"
            :email="profileData.email"
            :phone="profileData.phone"
            :status="profileData.status_profile"
            v-cloak
        ></UserData>

    </div>
</template>

<script>
import UserImg from "./QuestionnaireComponents/UserImg";
import UserData from "./QuestionnaireComponents/UserData";

export default {
    name: "NewUserProfile",
    props: {
        profileData: {
            type: Object,
            default: {}
        }
    },
    components: {
        UserImg,
        UserData,
    },
}
</script>

<style>
</style>
