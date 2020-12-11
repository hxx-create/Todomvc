module.exports = {
  //选项...
  devServer: {
    port: 8081,
    https: false,
    proxy: {
      "/api": {
        target: "http://localhost:8080/",
        changeOrigin: true,
        ws: true,
        pathRewrite: {
          "^/api": "",
        },
      },
    },
  },
};
