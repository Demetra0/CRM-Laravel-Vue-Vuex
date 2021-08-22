<template>
    <div class="manager-history__logs-element" >

        <div class="logs-element__avatar">
            <AvatarUser
                :statusUser="oneProfile.status_profile"
                :url_avatar="oneProfile.picture"
            ></AvatarUser>
        </div>

        <div class="logs-element__data">
            <DataUser
                :id="oneProfile.id"
                :name-user="oneProfile.name"
                :time-of-validity="oneProfile.created_at"
                :statusUser="oneProfile.status_profile"
            >
            </DataUser>
        </div>
    </div>
</template>

<script>
import AvatarUser from "./UsersLogsComponents/AvatarUser";
import DataUser from "./UsersLogsComponents/DataUserLogs";
import ButtonsManagement from "../ButtonsManagament/ButtonsManagement";
import NewUserProfile from "../UsersProfile/NewUserProfile";

export default {
    name: "UsersLogs",
    props:[
        'oneProfile',
    ],
    mounted() {
    },
    components: {
        AvatarUser,
        DataUser,
        ButtonsManagement,
        NewUserProfile,
    },

}
</script>

<style lang="scss">
    .manager-history__logs-element {
        display: flex;
        width: 375px;
        height: 76px;
        margin: 0 auto;
    }
    .logs-element {
        &__avatar {
        }

        &__data {
            margin-left: 12px;
        }
    }
</style>
