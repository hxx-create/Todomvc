<template>
  <div class="register-container">
    <a-form ref="form" :model="form" class="register-form">
      <h2 class="title">用户注册</h2>
      <a-form-item>
        <a-input
          v-model="form.username"
          v-decorator="[
            'userName',
            {
              rules: [
                { required: true, message: 'Please input your username!' },
              ],
            },
          ]"
          placeholder="Username"
        >
          <a-icon
            slot="prefix"
            type="user"
            style="color: rgba(0, 0, 0, 0.25)"
          />
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-input
          v-model="form.password"
          v-decorator="[
            'password',
            {
              rules: [
                { required: true, message: 'Please input your Password!' },
              ],
            },
          ]"
          type="password"
          placeholder="Password"
        >
          <a-icon
            slot="prefix"
            type="lock"
            style="color: rgba(0, 0, 0, 0.25)"
          />
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-input
          v-model="form.cpassword"
          v-decorator="[
            'password',
            {
              rules: [
                { required: true, message: 'Please input your Password!' },
              ],
            },
          ]"
          type="password"
          placeholder="Password"
        >
          <a-icon
            slot="prefix"
            type="lock"
            style="color: rgba(0, 0, 0, 0.25)"
          />
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-button class="submit" type="primary" @click="onRegister"
          >注册</a-button
        >
        已有账号?
        <router-link to="./login">去登录</router-link>
      </a-form-item>
    </a-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {},
    };
  },
  methods: {
    onRegister() {
      if (this.form.password != this.form.cpassword) {
        return 0;
      }
    },
  },
};
</script>

<style lang="less" scoped>
.register-form {
  width: 500px;
  height: 400px;
  margin: 0 auto;
}
/* 注册按钮 */
.register {
  width: 100%;
  height: 45px;
  font-size: 16px;
}
/* 用户登陆标题 */
.title {
  margin-bottom: 50px;
  font-weight: 700;
  font-size: 24px;
}
/* 输入框 */
.inputBox {
  height: 45px;
  margin-top: 5px;
}
/* 输入框内左边距50px */
.ant-input-affix-wrapper .ant-input:not(:first-child) {
  padding-left: 50px;
}
.ant-form-item {
  margin-bottom: 15px;
}
</style>
