import java.applet.*;
import java.awt.*;
import java.awt.event.*;

public class ChangingFace extends Panel implements ActionListener
    {
    private int isHappy,isSad,isOk;
    private Button happyButton = new Button("Smile");
    private Button sadButton = new Button("Frown");
    private Button straightButton = new Button("Straight");

        public ChangingFace(){
        add(happyButton);
        add(sadButton);
        add(straightButton);
        happyButton.addActionListener(this);
        sadButton.addActionListener(this);
        straightButton.addActionListener(this);
    } //end ChangingFace


        public void paint(Graphics g){
        g.setColor(Color.red);
        g.drawOval(85,95,75,75);
        g.setColor(Color.blue);
        g.drawOval(100,115,10,10);
        g.drawOval(135,115,10,10);
        g.drawString("Changing Face", 80,205);


            if(isHappy == 1){
            g.drawArc(102,135,40,25,0,-180);
        }


            if(isSad == 2) {
            g.drawArc(102,135,40,25,0,180);
        } // end if


            if(isOk == 3){
            g.drawLine(102,145,145,145);
        }
    }// end paint


        public void actionPerformed(ActionEvent e){


            if(e.getSource() == happyButton ) {
            isHappy = 1;
            isSad = 4;
            isOk = 7;
            repaint(); // uses paint method
        } //end if
        if(e.getSource() == sadButton){ 
        isSad =2 ;
        isHappy =5 ;
        isOk = 8;
        repaint(); // uses paint method
    } //end if


        if(e.getSource() == straightButton){
        	
        	
        	isOk =3 ;
        isHappy = 6;
        isSad = 9;
        repaint(); // uses paint method
        	
        	}
        	
    } // end actionPerfomed
} //end class ChangingFace