<template>
    <div>
            <IconAccepted
                v-if="statusUser === statusUserList[0]"
                :url_avatar="url_avatar"
                :statusUser="statusUser"
            ></IconAccepted>

            <IconRejected
                v-if="statusUser === statusUserList[1]"
                :url_avatar="url_avatar"
                :statusUser="statusUser"
            ></IconRejected>

            <IconDeleted
                v-if="statusUser === statusUserList[2]"
                :statusUser="statusUser"
            ></IconDeleted>

    </div>
</template>

<script>

import IconAccepted from "./iconStatus/IconAccepted"
import IconRejected from "./iconStatus/IconRejected"
import IconDeleted from "./iconStatus/IconDeleted"

export default {
    name: "AvatarUser",
    props: [
        'statusUser',
        'url_avatar',
    ],
    data(){
      return {
          statusUserList: [
              'accepted',
              'rejected',
              'deleted',
          ],
      }
    },
    components: {
        IconAccepted,
        IconRejected,
        IconDeleted,
    },
    methods: {
    }
}
</script>

<style lang="scss">

    // Стили для иконок
    $acceptedColor: #34C759;    // Color:  photo accepted
    $rejectedColor: #FF006B;    // Color:  photo rejected
    $deletedColor: #ABB2C6;     // Color:  photo deleted

    .accepted .b-avatar-badge{
        background-color: $acceptedColor;
        -webkit-box-shadow: 2px 2px 7px 5px rgba(52, 199, 89, 0.28);
        -moz-box-shadow: 2px 2px 7px 5px rgba(52, 199, 89, 0.28);
        box-shadow: 2px 2px 7px 5px rgba(52, 199, 89, 0.28);
    }
    .rejected .b-avatar-badge{
        background-color: $rejectedColor;
        -webkit-box-shadow: 2px 2px 7px 5px rgba(255, 0, 107, 0.28);
        -moz-box-shadow: 2px 2px 7px 5px rgba(255, 0, 107, 0.28);
        box-shadow: 2px 2px 7px 5px rgba(255, 0, 107, 0.28);
    }
    .deleted .b-avatar-badge{
        background-color: $deletedColor;
        -webkit-box-shadow: 2px 2px 7px 5px rgba(146, 150, 163, 0.28);
        -moz-box-shadow: 2px 2px 7px 5px rgba(146, 150, 163, 0.28);
        box-shadow: 2px 2px 7px 5px rgba(146, 150, 163, 0.28);
    }

</style>
