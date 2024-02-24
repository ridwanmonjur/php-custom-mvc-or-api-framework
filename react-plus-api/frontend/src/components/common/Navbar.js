export function Navbar({ title, titleHyperlink, children }) {
  return (
    <nav className="navbar is-warning py-5">
      <div className="navbar-brand px-5 mx-5">
        <a className="navbar-item" href={titleHyperlink}>
          {title}
        </a>
        <div className="navbar-burger burger" data-target="navMenubd-example">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div
        id="navMenubd-example"
        className="navbar-menu mx-5 mt-2 px-5 has-background-warning is-shadowless"
      >
        <div className="navbar-end">{children}</div>
      </div>
    </nav>
  );
}
