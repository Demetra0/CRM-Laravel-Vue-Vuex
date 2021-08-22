<template>
    <div class="logs-element__name-user" >
      <router-link :to="getUrl">
        <p
            v-if="statusUser === 'deleted'"
            class="logs-element__name-and-status"
        >
            <span class="deleted-name-user">{{nameUser}}</span> {{statusUser}}
        </p>

        <p
            v-else class="logs-element__name-and-status"
        >
            <span class="active-name-user">{{nameUser}}</span> photo {{statusUser}}
        </p>
      </router-link>
        <p class="logs-element__time">{{ timeOfValidity }}</p>
    </div>
</template>

<script>
export default {
  name: "DataUser",
  data: () => ({
    routeClickProfile: '/profile/'
  }),
  props: [
    'nameUser',
    'timeOfValidity',
    'statusUser',
    'id'
  ],
  computed: {
    getUrl() {
      return this.routeClickProfile + this.id
    }

  },
}
</script>

<style lang="scss">
    $colorName: #007AFF;
    $colorData:  #ABB2C6;

    .logs-element {
      &__name-user a {
        text-decoration: none !important;
      }

      &__name-and-status {
        color: black;
      }

      &__name-and-status {
        margin: 0;
        font-weight: 500;
        font-size: 17px;
        line-height: 22px;

        letter-spacing: -0.408px;
      }

      &__time {
        margin: 0;
        color: $colorData;
        font-weight: normal;
        font-size: 15px;
        line-height: 22px;

        letter-spacing: -0.24px;
      }
    }
    .active-name-user{
        color: $colorName;
    }
    .deleted-name-user{
        color: $colorData;
    }
</style>
