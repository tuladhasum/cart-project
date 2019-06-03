<template>
    <div>
        <select class="form-control form-control-sm"
                name="quantity" id=""
                v-model="quantity"
                :value="quantity"
                @change="updateCart">
            <option v-for="(qty,i) in quantities" :key="i">{{qty}}</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "CartUpdateQuantity",
        props: ['initQuantity','productId'],
        methods: {
            updateCart() {
                const id = this.productId;
                axios.patch(`/cart/${id}`, {
                    quantity: this.quantity
                }).then(response => {
                    console.log(response);
                    window.location.href = "/cart";
                }).catch(error => {
                    // console.log(error);
                    window.location.href = '/cart';
                });
            }
        },
        data() {
            return {
                quantity: this.initQuantity,
                quantities: [1, 2, 3, 4, 5, 6]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
