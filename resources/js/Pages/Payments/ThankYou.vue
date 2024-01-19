<template>
    <Layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('payments')">
                        <PrimaryButton>Voltar</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="container mx-auto mt-8">
                    <div class="bg-gray-200 p-8 rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">{{ payment.customer.name }},</h2>
                    <h2 class="text-2xl font-semibold mb-4">Obrigado pela compra!</h2>
                    <p>Seu pedido foi realizado com sucesso.</p>

                    <div v-if="payment.method.name === 'CreditCard'">
                        <p>Sua compra foi aprovado no cartão de crédito.</p>
                        <img src="/icons/confirmed.png" width="200" height="300"/>
                    </div>

                    <div v-if="payment.method.name === 'Pix'">
                        <p>Realize o Pagamento pelo QR-Code Abaixo ou com o Pix Copia e Cola</p>
                        <div class="mt-6">
                            <img :src="`data:image/png;base64,${payment.qr_code}`" />
                        </div>
                        <textarea ref="pixCodeInput" rows="6" cols="50" readonly v-model="payment.copia_cola"></textarea>
                        <PrimaryButton @click="copy">Copiar</PrimaryButton>
                    </div>

                    <div v-if="payment.method.name === 'Boleto'">
                        <a :href="`${payment.url}`" target="_blank">
                            <PrimaryButton>Gerar Boleto para Pagamento</PrimaryButton>
                        </a>
                        <img src="/icons/confirmed.png" width="200" height="300"/>
                    </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Layout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        payment: Object,
    },
    data() {
        return {
            form: useForm({
                pixCodeInput: this.payment.copia_cola,
            })
        };
    },
    mounted() {
    },
    methods: {
        copy() {
            const element = this.$refs.pixCodeInput;
            element.select();
            element.setSelectionRange(0, 99999);
            document.execCommand('copy');
        }
    },
};
</script>
