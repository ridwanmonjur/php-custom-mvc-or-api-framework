export const getErrorMessage = (error) => {
  return `${error.response?.status || ""} Error: ${
    error.response?.data?.message || error.message
  }`;
};
