import '../styles/blocks.css';
import AddCidade from '../utils/addCidade';
import Footer from './footer';
import Header from './header';

function Section() {
    return (
        <div className="App">
          
          <Header />
          <AddCidade />
          <Footer />
  
          </div>
    );
}

export default Section;