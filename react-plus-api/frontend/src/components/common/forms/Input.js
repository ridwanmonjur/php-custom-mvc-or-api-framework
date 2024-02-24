import { forwardRef } from "react";

export const Input = forwardRef(
  ({ type, classNames, id, defaultValue = "", onClick, ...props }, ref) => {
    return (
      <input
        type={type}
        id={id}
        ref={ref}
        defaultValue={defaultValue}
        onClick={onClick}
        className={`input is-warning ${
          classNames !== undefined ? classNames : ""
        }`}
        {...props}
      />
    );
  }
);
