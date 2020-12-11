<template>
  <div class="todo-container">
    <a-button type="primary" @click="addHandler"> 添加todo</a-button>
    <a-table
      :row-selection="rowSelection"
      :columns="columns"
      :data-source="dataList"
    >
      <a slot="content" slot-scope="Content">{{ Content }}</a>
      <span slot="customTitle">TODO</span>
      <span slot="action" slot-scope="record">
        <a-icon
          class="todo-icon-edit"
          type="edit"
          @click="handleEdit(record)"
        />
        <a-icon
          class="todo-icon-delete"
          type="delete"
          @click="handleDel(record)"
        />
      </span>
    </a-table>

    <a-form-model
      v-if="isVisible"
      :model="form"
      :label-col="{ span: 4 }"
      :wrapper-col="{ span: 14 }"
    >
      <a-form-model-item label="Todo">
        <a-input v-model="form.content" />
      </a-form-model-item>
      <a-form-model-item label="Status">
        <a-select v-model="form.status" placeholder="please select your zone">
          <a-select-option value="finish"> 已完成 </a-select-option>
          <a-select-option value="active"> 未完成 </a-select-option>
        </a-select>
      </a-form-model-item>
      <a-form-model-item :wrapper-col="{ span: 14, offset: 4 }">
        <a-button type="primary" @click="onSubmitForm"> 添加TODO </a-button>
        <a-button style="margin-left: 10px" @click="closeFormModel">
          修改完成
        </a-button>
      </a-form-model-item>
    </a-form-model>
    <div class="todo-footer">
      <a-button class="todo-show" @click="showAll()">ALL</a-button>
      <a-button class="todo-show" @click="showActive()">Active</a-button>
      <a-button class="todo-show" @click="showFinish()">Finish</a-button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isVisible: false,
      content: "",
      status: "",
      data: [],
      dataList: [],
      columns: [
        {
          dataIndex: "content",
          slots: { title: "customTitle" },
          scopedSlots: { customRender: "content" },
        },
        {
          title: "Status",
          dataIndex: "status",
          scopedSlots: { customRender: "status" },
        },
        {
          title: "Action",
          scopedSlots: { customRender: "action" },
        },
      ],
      form: {},
      filelist: [],
      created() {
        this.dataList = this.data;
      },
    };
  },
  computed: {
    rowSelection() {
      return {
        onChange: (selectedRowKeys, selectedRows) => {
          console.log(
            `selectedRowKeys: ${selectedRowKeys}`,
            "selectedRows: ",
            selectedRows
          );
        },
        getCheckboxProps: (record) => ({
          props: {
            name: record.name,
          },
        }),
      };
    },
  },
  methods: {
    closeFormModel() {
      this.isVisible = false;
    },
    onSubmitForm() {
      this.isVisible = false;
      this.data.push(this.form);
      this.dataList = this.data;
    },
    handleEdit(record) {
      this.form = record;
      this.isVisible = true;
    },
    addHandler() {
      this.form = {};
      this.isVisible = !this.isVisible;
      // this.loadData();
    },
    handleDel(rowIndex) {
      // console.log(rowIndex);
      this.data.splice(this.data.indexOf(rowIndex), 1);
      this.dataList = this.data;
    },
    showAll() {
      this.dataList = this.data.filter((item) => item.status !== "");
    },
    showActive() {
      this.dataList = this.data.filter((item) => item.status == "active");
    },
    showFinish() {
      this.dataList = this.data.filter((item) => item.status == "finish");
    },
  },
};
</script>
<style lang="less" scoped>
.todo-icon-edit {
  color: green;
}
.todo-icon-delete {
  color: red;
  margin-left: 25px;
}
.todo-footer {
  margin-top: 400px;
  .todo-show {
    width: 70px;
    margin: 20px;
  }
}
</style>
