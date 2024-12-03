import AddCidade from './utils/addCidade';
import Footer from './blocks/footer';
import Header from './blocks/header';
import Section from './blocks/section';
import './styles/App.css';

function App() {
  return (
    <div className="App">
      
      <Header />
      <AddCidade />
      <Section />
      <Footer />
      
      
      
      {/*
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
      */}
      
    </div>
  );
}

export default App;
