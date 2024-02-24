export const Label = ({ htmlFor, classNames, children }) => {
  return (
    <label
      htmlFor={htmlFor}
      className={`label ${
        typeof classNames !== "undefined" && classNames !== null
          ? classNames
          : ""
      }`}
    >
      {children}
    </label>
  );
};
