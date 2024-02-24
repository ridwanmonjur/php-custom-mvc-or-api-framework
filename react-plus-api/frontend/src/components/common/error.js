export function Error({ error }) {
  console.log({
    error,
    check1: typeof error === "undefined",
    check2: error === null
  });
  return (
    <>
      {typeof error === "undefined" || error === null ? (
        <> </>
      ) : (
        <>
          <div className="notification is-danger is-light">
            <ul>
              <li> {error} </li>
            </ul>
          </div>
        </>
      )}
    </>
  );
}
