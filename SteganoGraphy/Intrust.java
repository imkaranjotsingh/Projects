import java.util.*;

class Intrust extends Exception
{
	public static void main(String as[])throws Exception
	{
		double  p,t,r,i,a;
		Scanner s = new Scanner(System.in);
		p = s.nextInt();
		t = s.nextInt();
		r = s.nextInt();
		i =p*Math.pow((1+r/100),t);
		System.out.println(i);
	}
}