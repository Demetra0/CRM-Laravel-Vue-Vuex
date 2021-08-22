<template>
    <div class="col-12 col-md-6 col-lg-8 float-right">
        <div class="user-profile__main-info">

            <div class="user-profile__name-and-age">
                <h2>{{ name }}, {{age}}</h2>
            </div>

            <div class="user-profile__sub-info">

                <div class="user-profile__info">
                    <p class="user-profile__item-info">Info</p>
                </div>

                <div class="user-profile__user-info">

                    <DataField
                        title="Birth data"
                        :data="birth_data"
                    ></DataField>

                    <DataField
                        title="E-mail"
                        :data="email"
                    ></DataField>

                    <DataField
                        title="Phone"
                        :data="phone"
                    ></DataField>

                    <DataField v-if="status"
                        title="Status profile"
                        :data="status"
                    ></DataField>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

import DataField from "./DataField";

export default {
    name: "UserData",
    props: {
        name: {
            type: String,
            default: "None"
        },
        age: {
            type: String,
            default: "None"
        },
        birth_data: {
            type: String,
            default: "None"
        },
        email: {
            type: String,
            default: "None"
        },
        phone: {
            type: String,
            default: "None"
        },
        status: {
            type: String,
            default: "None"
        }
    },
    components: {
        DataField
    }
}
</script>

<style lang="scss">
.user-profile{
    // name + age
    &__name-and-age {
        font-weight: bold;
        font-size: 34px;
    }
    // info block
    &__sub-info {
        margin-top: 30px;
    }
    // Style for INFO
    &__info {
        text-transform: uppercase;
        font-weight: 500;
        font-size: 13px;
        color: #ABB2C6;
        margin-bottom: 15px;
    }
}
</style>
