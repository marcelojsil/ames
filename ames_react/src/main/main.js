import AddCidade from './utils/addCidade';
import Footer from './blocks/footer';
import Header from './blocks/header';
import Section from './blocks/section';
import '../styles/App.css';

function Main() {
    return (
      <div className="App">
        
        <Header />
        <AddCidade />
        <Footer />

        </div>
  );
}

export default Main;