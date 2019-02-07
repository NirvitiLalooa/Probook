package service;

import javax.jws.WebMethod;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public interface BookWSInterface {
	@WebMethod
	public String searchBook(String title, int startIdx, int maxResults);
	@WebMethod
	public String detailBook(String id);
	@WebMethod
	public String buyBook(String id, int quantity, String accNum);
	@WebMethod
	public String recommendBook(String[] categories);
}
