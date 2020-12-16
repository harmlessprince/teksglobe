<template>
    <div class="col-md-8 col-sm-12 col-12 mx-auto">
        <Alert :alert="alert" />
        <form method="post" @submit.prevent="confirmWithdraw">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Withdrawal</h5>
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
                                <label for="pin" class="col-form-label">Pin</label>
                                <input id="pin" required type="password" v-model="form.pin" class="form-control form-control-lg" name="pin">
                                <span class="invalid-feedback d-block" role="alert" v-if="pinError">
                                    <strong>{{ pinError }}</strong>
                                </span>
                            </div>
                        </div>
                        <section class="col-12" v-if="withdrawStatus && pinStatus">
                            <div class="row">
                                <div class="col-12 mt-2 card-action" v-if="confirm">
                                    <button v-if="!processing" type="button" class="btn btn-primary" :disabled="processing" @click="cancelWithdraw">Cancel</button>
                                    <button class="btn btn-primary" type="button" :disabled="processing" @click="withdrawFunds">
                                        <span v-if="processing" class="dashboard-spinner spinner-white spinner-xs"></span>
                                        <span v-else>Withdraw</span>
                                    </button>
                                </div>
                                <div class="col-12 mt-2 card-action" v-else>
                                    <button type="submit" class="btn btn-primary" :disabled="processing">Submit</button>
                                </div>
                            </div>
                        </section>
                        <p class="col-12" v-else-if="!withdrawStatus"><em>You do not have your bank details on the system. Click <a :href="profileUrl"><u>Here</u></a> to add your bank details</em></p>
                        <p class="col-12" v-else-if="!pinStatus"><em>You have not created a pin for you account.Click <a :href="profileUrl"><u>Here</u></a> to create your pin</em></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Alert from './Alert.vue';

    let timeout;
    export default {
        props: {
            withdrawUrl: {
                type: String,
                required: true,
            },
            profileUrl: {
                type: String,
                required: true,
            },
            withdrawStatus: {
                type: Number,
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
                    pin: '',
                },
                confirm: false,
                errors: {},
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
                    clearTimeout(timeout);
                    timeout = setTimeout(() => this.showAlert(), 5000);
                }
            }
        },
        methods: {
            confirmWithdraw() {
                this.confirm = true;
            },
            async withdrawFunds() {
                try {
                    this.processing = true;
                    this.errors = {};
                    const res = await axios.post(this.withdrawUrl, { ...this.form });
                    this.resetForm();
                    this.showAlert(true, 'success', res.data.message);
                    this.confirm = false;
                } catch (e) {
                    this.errors = e.response.data.payload;
                    this.cancelWithdraw();
                    this.showAlert(true, 'danger', e.response.data.message);
                } finally {
                    this.processing = false;
                }
            },
            cancelWithdraw() {
                this.confirm = false;
                this.form.pin = '';
            },
            resetForm() {
                this.form.amount = '';
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
            pinError() {
                return (this.errors.hasOwnProperty('pin')) ? this.errors.pin[0] : false;
            },
        }
    };
</script>
