<template>
    <b-button type="submit" variant="primary" class="btn-delete">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="#747987" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M7.99999 0C6.41774 0 4.871 0.469192 3.55541 1.34824C2.23981 2.22729 1.21443 3.47672 0.608933 4.93853C0.00343233 6.40034 -0.154949 8.00887 0.153733 9.56072C0.462415 11.1126 1.22431 12.538 2.34313 13.6569C3.46195 14.7757 4.88741 15.5376 6.43926 15.8463C7.9911 16.155 9.59964 15.9965 11.0614 15.391C12.5233 14.7855 13.7727 13.7602 14.6517 12.4446C15.5308 11.129 16 9.58225 16 8C15.9976 5.879 15.154 3.84555 13.6542 2.34578C12.1544 0.846001 10.121 0.00238211 7.99999 0ZM14 8C14.0005 9.24545 13.6114 10.4599 12.887 11.473L4.52696 3.113C5.42378 2.47378 6.47943 2.09401 7.57793 2.01535C8.67643 1.9367 9.77533 2.1622 10.7541 2.66713C11.7328 3.17205 12.5535 3.93686 13.1261 4.87761C13.6987 5.81837 14.0011 6.89869 14 8ZM1.99999 8C1.99945 6.75455 2.38861 5.54014 3.11296 4.527L11.473 12.887C10.5762 13.5262 9.52054 13.906 8.42204 13.9846C7.32355 14.0633 6.22464 13.8378 5.2459 13.3329C4.26715 12.828 3.44642 12.0631 2.87383 11.1224C2.30123 10.1816 1.99889 9.10131 1.99999 8Z"
                  />
        </svg>
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
    .btn-delete{
        padding: 8px 45px;
        margin-top: 15px;
        color: #747987;
        border: none;
        background: #F2F2F3;
        border-radius: 9.27273px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .btn-delete:hover{
        background: #747987;
        color: #ffffff;
    }
    .btn-delete svg{
        pointer-events:all;
        font-size: 125%;
        vertical-align: text-bottom;
        margin-bottom: 2px;
        margin-right: 3px;
    }
    .btn-delete:hover svg{
        fill: #ffffff;
    }

</style>
