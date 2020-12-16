<template>
    <div class="col-md-8 col-sm-12 col-12 mx-auto">
        <Alert :alert="alert" />
        <form method="post" @submit.prevent="confirmTransfer" v-if="!hasRecepient">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Transfer</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount" class="col-form-label">Amount</label>
                                <input id="amount" required type="number" v-model.number="form.amount" class="form-control form-control-lg" name="amount">
                                <span class="invalid-feedback d-block" role="alert" v-if="amountError">
                                    <strong>{{ amountError }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email/Phone</label>
                                <input id="email" required type="email" v-model="form.email" class="form-control form-control-lg" name="email">
                                <span class="invalid-feedback d-block" role="alert" v-if="emailError">
                                    <strong>{{ emailError }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pin" class="col-form-label">Pin</label>
                                <input id="pin" required type="password" v-model="form.pin" class="form-control form-control-lg" name="pin">
                                <span class="invalid-feedback d-block" role="alert" v-if="pinError">
                                    <strong>{{ pinError }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 mt-2 card-action" v-if="pinStatus">
                            <button type="submit" class="btn btn-primary" :disabled="processing">
                                <span v-if="processing" class="dashboard-spinner spinner-white spinner-xs"></span>
                                <span v-else>Submit</span>
                            </button>
                        </div>
                        <p class="col-12" v-else-if="!pinStatus"><em>You have not created a pin for you account.Click <a :href="pinUrl"><u>Here</u></a> to create your pin</em></p>
                    </div>
                </div>
            </div>
        </form>
        <div class="card" v-else>
            <div class="card-header card-header-primary">
                <h4 class="card-title"><strong>Confirm Transfer</strong></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 pr-0">
                        <img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="..." width="100%" style="max-height: 300px">
                    </div>
                    <div class="col-sm-6">
                        <h3 class="font-weight-bold">{{ recepient.account.name }}</h3>
                        <h5 class="font-weight-bold">{{ recepient.email }}</h5>
                        <h5 class="font-weight-bold">Amount To Transfer: {{ recepient.amount }}</h5>
                        <h5 class="font-weight-bold">Wallet Transfer</h5>
                        <button class="btn btn-primary" :disabled="processing" @click="cancelTransfer">
                            <span v-if="processing" class="dashboard-spinner spinner-white spinner-xs"></span>
                            <span v-else>Cancel</span>
                        </button>
                        <button class="btn btn-primary" :disabled="processing" @click="transferFunds">
                            <span v-if="processing" class="dashboard-spinner spinner-white spinner-xs"></span>
                            <span v-else>Transfer</span>
                        </button>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
    import Alert from './Alert.vue';

    let timeout;
    export default {
        props: {
            confirmUrl: {
                type: String,
                required: true,
            },
            transferUrl: {
                type: String,
                required: true,
            },
            pinUrl: {
                type: String,
                required: true,
            },
            pinStatus: {
                type: Number,
                required: true,
            },
        },
        components: {
            Alert,
        },
        data() {
            return {
                processing: false,
                form: {
                    amount: '',
                    email: '',
                    pin: '',
                },
                errors: {},
                hasRecepient: false,
                recepient: {},
                alert: {
                    msg: null,
                    show: false,
                    type: null,
                },
            }
        },
        watch: {
            alert(data) {
                if (data.show) {
                    console.log('clear');
                    clearTimeout(timeout);
                    timeout = setTimeout(() => this.showAlert(), 5000);
                }
            }
        },
        methods: {
            async confirmTransfer() {
                try {
                    this.showAlert();
                    this.processing = true;
                    const res = await axios.post(this.confirmUrl, { ...this.form });
                    this.recepient = res.data.payload;
                    this.hasRecepient = true;
                } catch (e) {
                    this.cancelTransfer();
                    this.errors = e.response.data.payload;
                } finally {
                    this.processing = false;
                }
            },
            async transferFunds() {
                try {
                    this.errors = {};
                    this.processing = true;
                    const res = await axios.post(this.transferUrl, { email: this.recepient.email, user: this.recepient.account.id, amount: this.recepient.amount });
                    this.resetForm();
                    this.recepient = {};
                    this.showAlert(true, 'success', res.data.message);
                    this.hasRecepient = false;
                } catch (e) {
                    this.showAlert(true, 'danger', e.response.data.message);
                } finally {
                    this.processing = false;
                }
            },
            cancelTransfer() {
                this.recepient = {},
                this.hasRecepient = false,
                this.form.pin = '';
            },
            resetForm() {
                this.form.amount = '';
                this.form.email = '';
                this.form.pin = '';
            },
            showAlert(show = false, type = '', msg = '') {
                this.alert = { show, type, msg };
            }
        },
        computed: {
            amountError() {
                return (this.errors.hasOwnProperty('amount')) ? this.errors.amount[0] : false;
            },
            emailError() {
                return (this.errors.hasOwnProperty('email')) ? this.errors.email[0] : false;
            },
            pinError() {
                return (this.errors.hasOwnProperty('pin')) ? this.errors.pin[0] : false;
            },
        }
    };
</script>
